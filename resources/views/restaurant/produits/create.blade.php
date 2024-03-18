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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                           <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Ajouter Produits</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.produits.store') }}" method="POST"
                                            enctype="multipart/form-data" id="addProduitForm">
                                            @csrf

                                            
                                            <div >
                                                <label for="categorie_rest_id">Categorie:</label>
                                                <select name="categorie_rest_id" class="form-control" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ request()->input('categorie_rest_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nom_produit">Nom Produit:</label>
                                                <input type="text" name="nom_produit" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea name="description" class="form-control" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" class="form-control"
                                                    id="imageInput">
                                                <div class="image-preview" ></div>
                                            </div>

                                      <div class="form-group">
										<label for="prix">Prix :</label>
										<input type="text" name="prix" class="form-control" required pattern="^\d+(\.\d{1,2})?$" 										title="Veuillez entrer un nombre valide avec jusqu'à deux décimales (par exemple, 9,90)">
									</div>



                                            <div class="form-group">
    <label for="famille_options">Choisir les familles d'Options correspondants:</label>
    @foreach ($familleOptions as $familleOption)
        <div class="form-check">
            <input type="checkbox" name="famille_options[]" class="form-check-input" value="{{ $familleOption->id }}" id="famille_option_{{ $familleOption->id }}">
            <label class="form-check-label" for="famille_option_{{ $familleOption->id }}">{{ $familleOption->nom_famille_option }}</label>
        </div>
    @endforeach
</div>
                  
                                         
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Créer</button>
                                            </div>
                                            
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
    <script>
 $(document).ready(function () {
  // Handle change event on family options select
  $('.famille-options-select').on('change', function () {
    var familleOptions = $(this).val();
    var optionsSelect = $('.options-select');

    // Clear existing options
    optionsSelect.empty();

    // Fetch and append options based on selected famille options
    $.ajax({
      url: "{{ route('admin.getOptionsByFamilleOptions') }}",
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        familleOptions: familleOptions
      },
      success: function (response) {
        try {
          var options = response; // No need to parse JSON, response is already an object/array

          // Append options to the options select
          $.each(options, function (key, value) {
            optionsSelect.append($('<option>', {
              value: value.id,
              text: value.nom_option
            }));
          });
        } catch (error) {
          console.error("Error parsing JSON response:", error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
      }
    });
  });
});


    </script>
@endsection
