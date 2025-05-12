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
          <h3 class="card-title">Form {{ $title }}</h3>
        </div>
        <div class="card-body">
          <form action="{{  route('Employe.update.plant.management') }}" method="POST"  class="mx-auto col-md-6" enctype="multipart/form-data">
          @csrf
          @method('PUT')


             <div class="mb-2">
              <label class="form-label"> Status Plants*</label>
               <input type="hidden" name="id_plants" class="form-control" value="{{ $id_plant }}" readonly>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                <option selected value="">Select</option>
                                 <option value="healthy" {{ old('status', $row->status ?? '') == 'healthy' ? 'selected' : '' }}>healthy</option>
                                 <option value="needs_attention" {{ old('status', $row->status ?? '') == 'needs_attention' ? 'selected' : '' }}>needs attention</option>
                                 <option value="damaged" {{ old('status', $row->status ?? '') == 'damaged' ? 'selected' : '' }}>damaged</option>
                            </select>
              @error('status')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-2">
              <label class="form-label"> Notes Plants</label>
              <textarea name="notes" class="form-control" id="notes" cols="30" rows="10">{{ $row->notes }}</textarea>
              @error('notes')
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

