
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
                      <h4 class="card-title">Categories</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
              
                      <h1>Edit Categorie</h1>

                      <form action="{{ route('restaurant.tables.update', $table) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
              
                          <!-- Add the necessary form fields to edit the table -->
                       

                          <div class="form-group">
                            <label for="type_methode">Désignation </label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{ $table->designation }}" required>
                                @error('designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                            <label for="type_methode">N° Personnes </label>
                                <input type="number" class="form-control" id="nbre_personnes" name="nbre_personnes" value="{{ $table->nbre_personnes }}" required>
                                @error('designation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                                                <img id="produitImage" src="{{ asset($table->photo) }}" alt="table Image">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" accept="image/*" class="form-control">
                                            </div>
                            
                
              
                          <button type="submit" class="btn btn-primary">Modifier</button>
                      </form>
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
            $('input[name="image"]').change(function () {
                // Get the selected file
                var file = $(this).prop('files')[0];

                // Create a URL object from the file
                var imageURL = URL.createObjectURL(file);

                // Update the image source with the new URL
                $('#produitImage').attr('src', imageURL);
            });
        });
    </script>