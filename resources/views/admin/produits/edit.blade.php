@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.left-menu')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.top-menu')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('admin.stat')
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Modifier Produit</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form method="POST" action="{{ route('admin.produits.update', $produit->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="categorie_id">Categorie:</label>
                                                <select name="categorie_id" required class="form-control">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $produit->categorie_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nom_produit">Nom Produit:</label>
                                                <input type="text" name="nom_produit" value="{{ $produit->nom_produit }}" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <input type="text" name="description" value="{{ $produit->description }}" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <img id="produitImage" src="{{ asset($produit->url_image) }}" alt="Produit Image">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" accept="image/*" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="prix">Prix:</label>
                                                <input type="number" name="prix" value="{{ $produit->prix }}" required class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
        <label for="famille_options">Choisir les familles d'Options correspondants:</label>
     



        @foreach ($familleOptions as $familleOption)
            <div class="form-check">
                <input type="checkbox" name="famille_options[]" class="form-check-input" value="{{ $familleOption->id }}" id="famille_option_{{ $familleOption->id }}" {{ in_array($familleOption->id, $produit->familleOptions->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="form-check-label" for="famille_option_{{ $familleOption->id }}">{{ $familleOption->nom_famille_option }}</label>
            </div>
        @endforeach
    </div>
                                         <br/>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">mettre à jour Product</button>
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
    <script>
      $(document).ready(function () {
  // Handle change event on family options select
  $('.famille-options-select').on('change', function () {
    var familleOptions = $(this).val();
    var optionsSelect = $('.options-select');

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

          // Filter options that are not already in optionsTable
          var existingOptions = [];
          $('#optionsTableBody tr').each(function () {
            var optionId = $(this).find('td:first').text().trim();
            existingOptions.push(optionId);
          });

          options = options.filter(function (option) {
            return !existingOptions.includes(option.id.toString());
          });

          // Append filtered options to the options select
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
