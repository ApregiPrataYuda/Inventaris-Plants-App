@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{ $title }}
          </h2>
          <p class="text-muted">
               {{ $title }}
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Management {{ $title }}</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('Admin.update.location.management') }}" method="POST"  class="mx-auto col-md-6">
          @csrf
          @method('PUT')

            <div class="mb-1">
              <label class="form-label"> Name Location*</label>
              <input type="hidden" name="id_locations" class="form-control" value="{{ $idloc }}" >
              <input type="text" name="name_locations" class="form-control" value="{{ $row->name_locations }}" placeholder="Enter location name">
              @error('name_locations')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Description Location*</label>
              <textarea name="description_locations" class="form-control" id="description_locations" cols="30" rows="10">{{ $row->description_locations }}</textarea>
              @error('description_locations')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
  
          
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-outline-primary">Update</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection 

