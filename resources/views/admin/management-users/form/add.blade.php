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
          <form action="{{ route('Admin.store.user') }}" method="POST"  class="mx-auto col-md-6">
          @csrf

            <div class="mb-1">
              <label class="form-label"> Fullname *</label>
              <input type="text" name="fullname" class="form-control" placeholder="Enter Fullname">
              @error('fullname')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

             <div class="mb-1">
              <label class="form-label"> Usename*</label>
              <input type="text" name="username" class="form-control" placeholder="Enter username">
              @error('username')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Password*</label>
              <input type="password" name="password" class="form-control" placeholder="Enter Password">
              @error('password')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-1">
              <label class="form-label"> Password Confirmation*</label>
              <input type="password" name="passconf" class="form-control" placeholder="Enter Password Kofirmation">
              @error('passconf')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Role*</label>
              <select name="role_id" id="role_id" class="form-control">
                  <option value="">-Select-</option>
                  <option value="1">Admin</option>
                  <option value="2">User/Employe</option>
              </select>
              @error('role_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

             <div class="mb-1">
              <label class="form-label"> Status*</label>
              <select name="is_active" id="is_active" class="form-control">
                  <option value="">-Select-</option>
                  <option value="1">Aktif</option>
                  <option value="0">Nonaktif</option>
              </select>
              @error('is_active')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
  
          
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-outline-primary">Submit</button>
              <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection 

