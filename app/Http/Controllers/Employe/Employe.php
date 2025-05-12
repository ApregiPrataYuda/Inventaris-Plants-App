<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Models\category;
use App\Http\Requests\CategoryValidation;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\location;
use App\Http\Requests\LocationValidation;
use App\Models\plants;
use App\Http\Requests\PlantValidation;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class Employe extends Controller
{
     protected $category;
     protected $location;
     protected $plants;
    public function __construct(category $category, location $location, plants $plants) {
        $this->category = $category;
        $this->location = $location;
        $this->plants = $plants;
    }

    public function Home () {
        $data = [
             'title' => 'Home Employe'
        ];
        return view('employe.home.file', $data);
    }


    public function plants() {
        $data = [
             'title' => 'Data Plants'
        ];
        return view('employe.plants.file', $data);
    }


    public function getDataPlants(Request $request)
{
    if ($request->ajax()) {
        $query = $this->plants
            ->select(
                'plants.*',
                'locations.name_locations as location_name',
                'plant_categories.name_category as category_name'
            )
            ->leftJoin('locations', 'plants.location_id', '=', 'locations.id_locations')
            ->leftJoin('plant_categories', 'plants.category_id', '=', 'plant_categories.id_category')
             ->where('plants.status', 'healthy')
            ->orderBy('plants.name', 'asc');

        return DataTables::of($query)
            ->addIndexColumn()

             ->addColumn('status', function($row) {
                    return "<span class='badge bg-green text-red-fg'>{$row->status}</span>";
                })

            ->addColumn('image', function($row) {
                $imageUrl = route('plants.image.show', ['filename' => $row->image]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })
            ->addColumn('details', function ($row) {
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-cp="' . htmlspecialchars($row->code_plants, ENT_QUOTES, 'UTF-8') . '"
                             data-pd="' . htmlspecialchars($row->planting_date, ENT_QUOTES, 'UTF-8') . '"
                             data-sn="' . htmlspecialchars($row->scientific_name, ENT_QUOTES, 'UTF-8') . '"
                             data-nt="' . htmlspecialchars($row->notes, ENT_QUOTES, 'UTF-8') . '"
                         >
                            <i class="fa fa-sticky-note"> Details</i>
                        </a>';
            })
            ->addColumn('action', function ($row) {
                $idCrypt = Crypt::encrypt($row->id_plants);
                $updatesn =  route('Employe.plant.view.update.data',$idCrypt);
                $btn = '<a href="'.$updatesn.'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                return $btn;
            })
            ->filterColumn('location_name', function($query, $keyword) {
                $query->where('locations.name_locations', 'like', "%{$keyword}%");
            })
            ->filterColumn('category_name', function($query, $keyword) {
                $query->where('plant_categories.name_category', 'like', "%{$keyword}%");
            })
            ->rawColumns(['action','details','image','status'])
            ->make(true);
    }
}


public function showPlants($id) {
         $getLocation = $this->location->all();
         $getCategory = $this->category->all();
         $idDecy = Crypt::decrypt($id);
          $getdata = $this->plants->findOrFail($idDecy);
            $data = [
                'title' => 'Plants Update Data',
                 'loc' => $getLocation,
                 'cat' => $getCategory,
                 'row' => $getdata,
                 'id_plant' => $id
            ];
            return view('employe.plants.form.update', $data);
    }


    
    public function UpdatePlants(Request $request) {
         try {
        try {
            $idPlant = $request->input('id_plants', null);
            $idDecy = Crypt::decrypt($idPlant);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Employe.plants')
                ->with('error', 'Invalid Plant ID!');
        }
        $plant = $this->plants->findOrFail($idDecy);
                // Update data di database
                   $plant->update([
                        'status' => $request->input('status'),
                        'notes' => $request->input('notes'),
                         'updated_at' => Carbon::now(),
                   ]);
                   // Redirect dengan pesan sukses
                      return redirect()->route('Employe.plants')->with('success','Plant updated successfully');
                } catch (\Throwable $th) {
                    return redirect()->route('Employe.plants')->with('error','Failed to updated data. Please try again.');
                }
    }



    public function LogPlants()  {
         $data = [
                'title' => 'Log Report Plants Data Needs Attention',
                'title2' => 'Log Report Plants Data damaged'
            ];
            return view('employe.plants-log.file', $data);
    }


    public function ReportPlants(Request $request)
{
    $plants = collect(); // default kosong

    if ($request->filled('status') || ($request->filled('start_date') && $request->filled('end_date'))) {
        // $query = Plants::query();
         $query = Plants::query()
        ->leftJoin('plant_categories', 'plants.category_id', '=', 'plant_categories.id_category')
        ->leftJoin('locations', 'plants.location_id', '=', 'locations.id_locations')
        ->select('plants.*', 'plant_categories.name_category', 'locations.name_locations');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = Carbon::parse($request->start_date)->startOfDay(); // 00:00:00
            $end = Carbon::parse($request->end_date)->endOfDay();       // 23:59:59

            $query->whereBetween('plants.updated_at', [$start, $end]);
        }

        $plants = $query->get();
    }

    return view('employe.plants-report.file', [
        'title' => 'Report Plants Data',
        'plants' => $plants,
    ]);
}

}
