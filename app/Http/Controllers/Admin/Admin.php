<?php

namespace App\Http\Controllers\Admin;

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




class Admin extends Controller
{

     protected $category;
     protected $location;
     protected $plants;
    public function __construct(category $category, location $location, plants $plants) {
        $this->category = $category;
        $this->location = $location;
        $this->plants = $plants;
    }

    public function Dashboard () {
        $totalCat = $this->category->count();
        $totalLoc = $this->location->count();
        $totalPlant = $this->plants->count();
       
        $data = [
             'title' => 'Dashboard',
              'totalCat' => $totalCat,
              'totalLoc' => $totalLoc,
              'totalPlant' => $totalPlant
        ];
        return view('admin.dashboard.file', $data);
    }



    // start code for category
   public function plantsCategory() {
            $data = [
                'title' => 'Category'
            ];
            return view('admin.category-plants.file', $data);
    }



   public  function getDataCategory(Request $request) {
         if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->category->orderBy('name_category', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('name_category', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $idCrypt = Crypt::encrypt($row->id_category);
                $updateCategory =  route('Admin.category.view.updates',$idCrypt);
                $deleteCategoryUrl = route('Admin.delete.category.management', ['id' => $idCrypt]);
                        $btn = '<a href="'. $updateCategory .'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="'.$deleteCategoryUrl.'" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    }



    public function CreateCategory() {
        $data = [
                'title' => 'Form Create Category'
            ];
            return view('admin.category-plants.form.created', $data);
    }


    public function StoreCategory(CategoryValidation $request)  {
        try {
      if (category::isCateExists($request->input('name_category'))) {
          return redirect()->route('Admin.category.plants')
              ->with('error', 'Category name already exists.');
      }

      $this->category->create([
          'name_category' => $request->input('name_category'),
          'description' => $request->input('description')
      ]);
      
  
     return redirect()->route('Admin.category.plants')->with('success','success save');
     } catch (\Throwable $th) {
         return redirect()->route('Admin.category.plants')->with('error','Failed to create data. Please try again.');
     }
    }



    public function showCategory(Request $request, $id)  {

          $idDecy = Crypt::decrypt($id);
          $getMenu = $this->category->findOrFail($idDecy);
           $data = [
                'title' => 'Form Update Category',
                'row' => $getMenu,
                'idcat' => $id
            ];
            return view('admin.category-plants.form.update', $data);
    }


     public function UpdateCategory(CategoryValidation $request) {
        try {
        try {
            $categoryid = $request->input('id_category');
            $idCategoryDecrypted = Crypt::decrypt($categoryid);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.menu.management')
                ->with('error', 'Invalid menu ID!');
        }
    
          $CatData = $this->category->findOrFail($idCategoryDecrypted);
    
          if (category::isCateupExists($request->input('name_category'), $idCategoryDecrypted)) {
            return redirect()->route('Admin.category.plants')
                ->with('error', 'Category name already exists!');
          }

          $CatData->update([
            'name_category' => $request->input('name_category'),
            'description' => $request->input('description')
        ]);
    
        return redirect()->route('Admin.category.plants')->with('success','update success');
    } catch (\Throwable $th) {
        return redirect()->route('Admin.category.plants')->with('error','Failed to update data. Please try again.');
    }
     }

     public function DeleteCategory($id)  {
    try {
        $idCategoryDecrypted = Crypt::decrypt($id);
        $catData = category::find($idCategoryDecrypted);

        if (!$catData) {
            return redirect()->route('Administrator.menu.management')
                ->with('error', 'Data ID Not Found!');
        }

        $catData->delete();
        
        return redirect()->route('Admin.category.plants')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Admin.category.plants')
            ->with('error', 'Invalid category ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Admin.category.plants')
            ->with('error', 'Failed to delete data. Please try again.');
    }
}

// end code for category

// start code for Location
public function plantsLocation()  {
            $data = [
                'title' => 'Plants Location'
            ];
            return view('admin.location-plants.file', $data);
}



public  function getDataLocation(Request $request) {
         if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->location->orderBy('name_locations', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('name_locations', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $idCrypt = Crypt::encrypt($row->id_locations);
                $updateLocation =  route('Admin.location.view.update',$idCrypt);
                $deleteLocationUrl = route('Admin.delete.location.management', ['id' => $idCrypt]);
                        $btn = '<a href="'.$updateLocation.'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="'.$deleteLocationUrl.'" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    }


    public function CreateLocation()  {
         $data = [
                'title' => 'Form Create Location'
            ];
            return view('admin.location-plants.form.create', $data);
    }


    public function StoreLocation(LocationValidation $request)  {
        try {
      if (location::isLocExists($request->input('name_locations'))) {
          return redirect()->route('Admin.location.plants')
              ->with('error', 'Location name already exists.');
      }

      $this->location->create([
          'name_locations' => $request->input('name_locations'),
          'description_locations' => $request->input('description_locations')
      ]);
      
  
     return redirect()->route('Admin.location.plants')->with('success','success save');
     } catch (\Throwable $th) {
         return redirect()->route('Admin.location.plants')->with('error','Failed to create data. Please try again.');
     }
    }


    public function showLocation($id) {
          $idDecy = Crypt::decrypt($id);
          $getLocation = $this->location->findOrFail($idDecy);
           $data = [
                'title' => 'Form Update Location',
                'row' => $getLocation,
                'idloc' => $id
            ];
            return view('admin.location-plants.form.update', $data);
    }



     public function UpdateLocation(LocationValidation $request) {
        try {
        try {
            $Locationid = $request->input('id_locations');
            $idLocDecrypted = Crypt::decrypt($Locationid);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.menu.management')
                ->with('error', 'Invalid Loc ID!');
        }
    
          $LocData = $this->location->findOrFail($idLocDecrypted);
    
          if (category::isCateupExists($request->input('name_locations'), $idLocDecrypted)) {
            return redirect()->route('Admin.location.plants')
                ->with('error', 'Location name already exists!');
          }

          $LocData->update([
             'name_locations' => $request->input('name_locations'),
          'description_locations' => $request->input('description_locations')
        ]);
    
        return redirect()->route('Admin.location.plants')->with('success','update success');
    } catch (\Throwable $th) {
        return redirect()->route('Admin.location.plants')->with('error','Failed to update data. Please try again.');
    }
     }


     public function DeleteLocation ($id) {
         try {
        $idLocDecrypted = Crypt::decrypt($id);
        $LocData = location::find($idLocDecrypted);
  

        if (!$LocData) {
            return redirect()->route('Admin.location.plants')
                ->with('error', 'Data ID Not Found!');
        }

        $LocData->delete();
        
        return redirect()->route('Admin.location.plants')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Admin.location.plants')
            ->with('error', 'Invalid location ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Admin.location.plants')
            ->with('error', 'Failed to delete data. Please try again.');
    }
     }
// end code for Location


// start code plant
public function plants()  {
        $data = [
                'title' => 'Plants Data Healty'
            ];
            return view('admin.plants.file', $data);
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
            //  ->where('plants.status', 'healthy')
            ->orderBy('plants.name', 'asc');

        return DataTables::of($query)
            ->addIndexColumn()

             ->addColumn('status', function($row) {
                    $color = match($row->status) {
                        'damaged' => 'bg-red text-white',
                        'healthy' => 'bg-green text-white',
                        'needs_attention' => 'bg-yellow text-dark',
                        default => 'bg-secondary text-white',
                    };

                    return "<span class='badge {$color}'>{$row->status}</span>";
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
                $updatesn =  route('Admin.plant.view.update.data',$idCrypt);
                $deleteds = route('Admin.delete.plants.management', ['id' => $idCrypt]);
                $btn = '<a href="'.$updatesn.'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= '<form action="'.$deleteds.'" method="POST" class="d-inline">
                            '.csrf_field().'
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" onclick="confirmDelete(this)" class="btn btn-pill btn-outline-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>';
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


public function CreatePlants()  {
         $getLocation = $this->location->all();
         $getCategory = $this->category->all();
        
            $data = [
                'title' => 'Plants Create Data',
                 'loc' => $getLocation,
                 'cat' => $getCategory
            ];
            return view('admin.plants.form.create', $data);
}


public function StorePlants(PlantValidation $request)  {
     try {
        //   cek name already exist
        if (plants::isnameExists($request->input('name'))) {
            return redirect()->route('Admin.plants')
                ->with('error', 'Name Plant already exists.');
        }

        if (plants::isnametwoExists($request->input('scientific_name'))) {
            return redirect()->route('Admin.plants')
                ->with('error', 'scientific name already exists.');
        }


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = $this->handleImageUpload($request->file('image'));
        } else {
            // Jika tidak ada gambar, gunakan default
            $imageName = 'default.jpg'; // Pastikan file ini ada di folder public/image atau sesuai path kamu
        }

       // Ambil record terakhir berdasarkan ID
        $latestPlant = $this->plants->orderBy('id_plants', 'desc')->first();
        $lastNumber = $latestPlant ? (int) substr($latestPlant->code_plants, -4) : 0;

        // Loop sampai dapat code_plants yang unik
        do {
            $lastNumber++;
            $generatedCode = 'PLANT-USAKTI-' . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
        } while ($this->plants->where('code_plants', $generatedCode)->exists());
  
        $this->plants->create([
            'name' => $request->input('name'),
            'code_plants' => $generatedCode,
            'scientific_name' => $request->input('scientific_name'),
            'category_id' => $request->input('category_id'),
            'location_id' => $request->input('location_id'),
            'status' => $request->input('status'),
            'planting_date' => $request->input('planting_date'),
            'notes' => $request->input('notes'),
            'image' => $imageName,
        ]);
        
       return redirect()->route('Admin.plants')->with('success','success save');
       } catch (\Throwable $th) {
           return redirect()->route('Admin.plants')->with('error','Failed to create data. Please try again.');
       }
}


 private function handleImageUpload($image)
    {
        if ($image) {
            $imagePath = $image->store('plants', 'public');
            return basename($imagePath); // Return the file name
        }
        return 'default.png'; // Return default image name if no image is uploaded
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
            return view('admin.plants.form.update', $data);
    }


    public function UpdatePlants(PlantValidation $request) {
         try {
        
        try {
            $idPlant = $request->input('id_plants', null);
           
            $idDecy = Crypt::decrypt($idPlant);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Admin.plants')
                ->with('error', 'Invalid Plant ID!');
        }

        $plant = $this->plants->findOrFail($idDecy);

           // ambil data gambar baru dan lama
           $newImage = $request->file('image');
           $oldImage = $request->input('imageold');
           // Jika ada gambar baru
           if ($newImage) {
             
               $imagePath =  $newImage->store('plants', 'public');
               $imageName = basename($imagePath);
   
              
               if ($oldImage && $oldImage !== 'default.jpg') {
                  //  $oldImagePath = storage_path('app/avatar/' . $oldImage);
                   $oldImagePath = storage_path('app/public/plants/' . $oldImage);
                   if (file_exists($oldImagePath)) {
                       unlink($oldImagePath);
                   }
               }
           } else {
               // Jika tidak ada gambar baru, gunakan gambar lama
               $imageName = $oldImage;
           }
                // Update data di database
                   $plant->update([
                        'name' => $request->input('name'),
                        'scientific_name' => $request->input('scientific_name'),
                        'category_id' => $request->input('category_id'),
                        'location_id' => $request->input('location_id'),
                        'status' => $request->input('status'),
                        'planting_date' => $request->input('planting_date'),
                        'notes' => $request->input('notes'),
                        'image' => $imageName,
                         'updated_at' => Carbon::now(),
                   ]);
                   // Redirect dengan pesan sukses
                      return redirect()->route('Admin.plants')->with('success','Plant updated successfully');
                } catch (\Throwable $th) {
                    return redirect()->route('Admin.plants')->with('error','Failed to updated data. Please try again.');
                }
    }

    public function DeletePlants($id)  {
         try {
            $idPlantDecrypted = Crypt::decrypt($id);
            $userData = plants::find($idPlantDecrypted);
            $images = $userData->image;
            if (!$userData) {
                return redirect()->route('Admin.plants')
                    ->with('error', 'Data ID Not Found!');
            }
            if ($images && $images !== 'default.jpg') {
                // Menentukan path file gambar di storage/app/avatar
                $imagePath = storage_path('app/public/plants/' . $images);
                // Memastikan gambar ada di folder tersebut dan menghapusnya
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $userData->delete();
            return redirect()->route('Admin.plants')->with('success', 'Success delete');
        } catch (DecryptException $e) {
            return redirect()->route('Admin.plants')
                ->with('error', 'Invalid ID!');
        } catch (\Throwable $th) {
            return redirect()->route('Admin.plants')
                ->with('error', 'Failed to delete data. Please try again.');
        }
    }

    // end code plant

     public function LogPlants() {
         $data = [
                'title' => 'Log Report Plants Data Needs Attention',
                'title2' => 'Log Report Plants Data damaged'
            ];
            return view('admin.plants-log.file', $data);
    }



    // code status need attention
    public function getDataPlantsNa(Request $request)
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
             ->where('plants.status', 'needs_attention')
            ->orderBy('plants.name', 'asc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                    return "<span class='badge bg-orange text-red-fg'>{$row->status}</span>";
                })

            ->addColumn('image', function($row) {
                $imageUrl = route('plants.image.show', ['filename' => $row->image]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })
            ->addColumn('details', function ($row) {
                return '<a id="setss" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-cp="' . htmlspecialchars($row->code_plants, ENT_QUOTES, 'UTF-8') . '"
                             data-pd="' . htmlspecialchars($row->planting_date, ENT_QUOTES, 'UTF-8') . '"
                             data-sn="' . htmlspecialchars($row->scientific_name, ENT_QUOTES, 'UTF-8') . '"
                             data-nt="' . htmlspecialchars($row->notes, ENT_QUOTES, 'UTF-8') . '"
                         >
                            <i class="fa fa-sticky-note"> Details</i>
                        </a>';
            })
            ->addColumn('action', function ($row) {
    
            })
            ->filterColumn('location_name', function($query, $keyword) {
                $query->where('locations.name_locations', 'like', "%{$keyword}%");
            })
            ->filterColumn('category_name', function($query, $keyword) {
                $query->where('plant_categories.name_category', 'like', "%{$keyword}%");
            })
            ->rawColumns(['status','details','image'])
            ->make(true);
    }
}





 public function getDataPlantsDmg(Request $request)
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
             ->where('plants.status', 'damaged')
            ->orderBy('plants.name', 'asc');

        return DataTables::of($query)
            ->addIndexColumn()

           ->addColumn('status', function($row) {
                    return "<span class='badge bg-red text-red-fg'>{$row->status}</span>";
                })

            ->addColumn('image', function($row) {
                $imageUrl = route('plants.image.show', ['filename' => $row->image]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })
            ->addColumn('details', function ($row) {
                return '<a id="setsss" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-cp="' . htmlspecialchars($row->code_plants, ENT_QUOTES, 'UTF-8') . '"
                             data-pd="' . htmlspecialchars($row->planting_date, ENT_QUOTES, 'UTF-8') . '"
                             data-sn="' . htmlspecialchars($row->scientific_name, ENT_QUOTES, 'UTF-8') . '"
                             data-nt="' . htmlspecialchars($row->notes, ENT_QUOTES, 'UTF-8') . '"
                         >
                            <i class="fa fa-sticky-note"> Details</i>
                        </a>';
            })
            ->addColumn('action', function ($row) {
    
            })
            ->filterColumn('location_name', function($query, $keyword) {
                $query->where('locations.name_locations', 'like', "%{$keyword}%");
            })
            ->filterColumn('category_name', function($query, $keyword) {
                $query->where('plant_categories.name_category', 'like', "%{$keyword}%");
            })
            ->rawColumns(['details','image','status'])
            ->make(true);
    }
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

    return view('admin.plants-report.file', [
        'title' => 'Report Plants Data',
        'plants' => $plants,
    ]);
}



public function exportPlantsPdf(Request $request)
{
    $statusText = 'Semua Status';

    $query = Plants::query()
        ->leftJoin('plant_categories', 'plants.category_id', '=', 'plant_categories.id_category')
        ->leftJoin('locations', 'plants.location_id', '=', 'locations.id_locations')
        ->select('plants.*', 'plant_categories.name_category', 'locations.name_locations');

    if ($request->filled('status')) {
        $query->where('plants.status', $request->status);
        $statusText = ucfirst(str_replace('_', ' ', $request->status));
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();
        $query->whereBetween('plants.updated_at', [$start, $end]);
    }

    $plants = $query->get();

    $pdf = Pdf::loadView('admin.plants-report.pdf', [
        'plants' => $plants,
        'title' => 'Laporan Tanaman : ' . $statusText,
    ])->setPaper('a4', 'landscape');

    return $pdf->download('report_plants.pdf');
}




}
