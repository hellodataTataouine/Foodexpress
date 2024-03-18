@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('restaurant.left-menu')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      @include('restaurant.top-menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Ajouter table </h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('restaurant.tables.store') }}"  enctype="multipart/form-data">
                            @csrf
                
                            <div class="form-group">
                            <label for="type_methode">Désignation </label>
                                <input type="text" class="form-control" id="designation" name="designation" required>
                                @error('designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                            <label for="type_methode">N° Personnes </label>
                                <input type="number" class="form-control" id="nbre_personnes" name="nbre_personnes" required>
                                @error('designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" class="form-control"
                                                    id="imageInput">
                                                <div class="image-preview" ></div>
                                            </div>
                
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          @include('footer')
        </div>
          </div>
       </div>
     @endsection
     <script>
        $(document).ready(function () {
            // Listen for changes in the file input
            $('#imageInput').on('change', function (e) {
                var files = e.target.files;
                var imagePreview = $('.image-preview');
                imagePreview.empty();

                // Loop through the selected files and create an image preview for each
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var image = $('<img style="width:700px;height:400px;">').attr('src', e.target.result).addClass('img-fluid');
                        imagePreview.append(image);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>