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
          <form action="{{  route('Admin.update.plant.management') }}" method="POST"  class="mx-auto col-md-6" enctype="multipart/form-data">
          @csrf
          @method('PUT')

         

            <div class="mb-2">
              <label class="form-label"> Name Plants*</label>
              <input type="hidden" name="id_plants" class="form-control" value="{{ $id_plant }}" readonly>
              <input type="text" name="name" class="form-control" value="{{ $row->name }}" placeholder="Enter Plants name">
              @error('name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-2">
              <label class="form-label"> Scientific Name Plants</label>
              <input type="text" name="scientific_name" value="{{ $row->scientific_name }}" class="form-control" placeholder="Enter Scientific name">
              @error('scientific_name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>


            <div class="mb-2">
              <label class="form-label"> Planting Date</label>
              <input type="date" name="planting_date" value="{{ $row->planting_date }}" class="form-control">
              @error('planting_date')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-2">
              <label class="form-label"> Category Plants*</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-Select-</option>
                    @foreach ($cat as $item)
                               <option value="{{ $item->id_category }}" {{ old('category_id', $row->category_id) == $item->id_category ? 'selected' : '' }}>{{ $item->name_category }}</option>
                    @endforeach
                </select>
              @error('category_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-2">
              <label class="form-label"> Location Plants*</label>
                <select name="location_id" id="location_id" class="form-control">
                    <option value="">-Select-</option>
                    @foreach ($loc as $item)
                           <option value="{{ $item->id_locations }}" {{ old('location_id', $row->location_id) == $item->id_locations ? 'selected' : '' }}>{{ $item->name_locations }}</option>
                    @endforeach
                </select>
              @error('location_id')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

             <div class="mb-2">
              <label class="form-label"> Status Plants*</label>
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

                <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Image <small class="text-danger">(opsional)</small></label>
                                <img id="imgPreview" src="{{ url('/plants/' . $row->image) }}" class="img-thumbnail" alt="Avatar" style="width: 100px;"/>
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
              <button type="submit" class="btn btn-outline-primary">Update</button>
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
                })
                });
    </script>

@endsection 

