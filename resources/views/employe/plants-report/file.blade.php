@extends('layouts.app')
@section('content')

 <!-- Page Header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            {{ $title }}
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
        </div>
        </div>
    </div>
    </div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<div id="flashInfo" data-flash="{{ session('info') }}"></div>
<div class="page-body">
<div class="container-xl">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Master {{ $title }}</h3>
        </div>
       

<div class="card-body border-bottom py-3">
    <form action="{{ route('Admin.report.plants') }}" method="GET">
        <div class="row align-items-end">

            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                <option selected value="">Select</option>
                                <option value="healthy" {{ old('status') == 'healthy' ? 'selected' : '' }}>healthy</option>
                                <option value="needs_attention" {{ old('status') == 'needs_attention' ? 'selected' : '' }}>needs_attention</option>
                                <option value="damaged" {{ old('status') == 'damaged' ? 'selected' : '' }}>damaged</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>

            <div class="col-md-2">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 mr-2">
                    <i class="fas fa-filter me-1"></i> Tampilkan
                </button>

               
            </div>

             <div class="col-md-1 d-flex align-items-end">

                <a href="{{ route('Employe.report.plants') }}" class="btn btn-warning w-100 mr-2">
                    <i class="fas fa-undo me-1"></i> Reset
                </a>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('Admin.report.plants.pdf', request()->query()) }}" class="btn btn-danger w-100">
                    <i class="fas fa-file-pdf me-1"></i> Export PDF
                </a>
            </div>

        </div>
    </form>
</div>




@if($plants->count())
    <div class="card mt-4 ml-2 mr-2">
        <div class="card-header">
            <h5 class="mb-0">List Plants</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
            <tr>
                <th>#</th>
                <th>Name Plants</th>
                <th>Name Scientific</th>
                <th>Kode</th>
                <th>Category Plants</th>
                <th>Location Plants</th>
                <th>Status</th>
                <th>Date Planting</th>
                <th>Updated Status Date</th>
                <th>Noted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plants as $plant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $plant->name }}</td>
                    <td>{{ $plant->scientific_name }}</td>
                    <td>{{ $plant->code_plants }}</td>
                    <td>{{ $plant->name_category }}</td>
                    <td>{{ $plant->name_locations }}</td>
                    <td>{{ ucfirst($plant->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($plant->planting_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($plant->updated_at)->format('d-m-Y') }}</td>
                     <td>{{ $plant->notes }}</td>
                </tr>
            @endforeach
        </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info mt-4 ml-2 mr-2">
       No data found.
    </div>
@endif







    </div>
</div>
</div>



@endsection
		