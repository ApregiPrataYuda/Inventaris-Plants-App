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
          <form action="{{ route('Admin.update.user.management') }}" method="POST"  class="mx-auto col-md-6"  enctype="multipart/form-data">
          @csrf
          @method('PUT')

            <div class="mb-1">
              <label class="form-label"> Fullname *</label>
              <input type="hidden" name="id_user" value="{{ $idEsse }}" class="form-control">
              <input type="text" name="fullname" value="{{ $row->fullname }}" class="form-control" placeholder="Enter Fullname">
              @error('fullname')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

             <div class="mb-1">
              <label class="form-label"> Usename*</label>
              <input type="text" name="username" value="{{ $row->username }}" class="form-control" placeholder="Enter username">
              @error('username')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Password*</label>
              <input type="password" name="password" class="form-control" placeholder="Enter Password">
                  <small class="badge badge-outline text-orange font-italic mt-1">Biarkan Kosong Jika password tidak Di ubah</small>
              @error('password')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-1">
              <label class="form-label"> Password Confirmation*</label>
              <input type="password" name="passconf" class="form-control" placeholder="Enter Password Kofirmation">
                  <small class="badge badge-outline text-orange font-italic mt-1">Biarkan Kosong Jika password tidak Di ubah</small>
              @error('passconf')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-1">
              <label class="form-label"> Role*</label>
              <select name="role_id" id="role_id" class="form-control">
                  <option value="">-Select-</option>
                  <option value="1" {{ old('role_id', $row->role_id ?? '') == 1 ? 'selected' : '' }}>Admin</option>
                  <option value="2" {{ old('role_id', $row->role_id ?? '') == 2 ? 'selected' : '' }}>User/Employe</option>
              </select>
              @error('role_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

             <div class="mb-1">
              <label class="form-label"> Status*</label>
              <select name="is_active" id="is_active" class="form-control">
                  <option value="">-Select-</option>
                  <option value="1" {{ old('is_active', $row->is_active ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ old('is_active', $row->is_active ?? '') == 0 ? 'selected' : '' }}>Nonaktif</option>
              </select>
              @error('is_active')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

                 <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Image <small class="text-danger">(opsional)</small></label>
                                <img id="imgPreview" src="{{ url('/avatar/' . $row->image) }}" class="img-thumbnail" alt="Avatar" style="width: 100px;"/>
                            </div>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" class="custom-file-input" id="image"  id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">
                        <input type="hidden" name="imageold" value="{{($row->image)}}" class="form-control mt-2" id="coversold">
                        <small class="text-danger font-italic">Rekomendasi image width 100px - Hight 100px - ext(jpg or png)</small>
                       @error('image')
                             <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>


                      <script>
                      $(".custom-file-input").on("change", function() {
                      var fileName = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                      });
                     </script>
  
          
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
<script type="text/javascript">
    // assetCode
    $(document).ready(function() {

                $("#image").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview")
                              .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
    });
</script>



@endsection 

