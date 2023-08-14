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
                    @include('restaurant.stat')
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Produit</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form method="POST" action="{{ route('restaurant.produits.update', $produit->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
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
                                                <label for="famille_options">Famille Options:</label>
                                                <select name="famille_options[]" class="form-control famille-options-select" multiple>
                                                    @foreach ($familleOptions as $familleOption)
                                                        <option value="{{ $familleOption->id }}" class="list-group-item">
                                                            {{ $familleOption->nom_famille_option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="options">Options:</label>
                                                <select name="options[]" class="form-control options-select" multiple>
                                                    @php
                                                        $existingOptionIds = $produit->options->pluck('id')->toArray();
                                                    @endphp
                                                    @foreach ($options as $option)
                                                        @unless(in_array($option->id, $existingOptionIds))
                                                            <option value="{{ $option->id }}" class="list-group-item">
                                                                {{ $option->nom_option }}
                                                            </option>
                                                        @endunless
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="options">Options:</label>
                                                <table class="table table-bordered" id="optionsTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Option</th>
                                                            <th>Value</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="optionsTableBody">
                                                        <!-- Existing options -->
                                                        @foreach($produit->options as $option)
                                                            <tr>
                                                                <td>{{ $option->id }}</td>
                                                                <td>{{ $option->nom_option }}</td>
                                                                <td>
                                                                    <a class="btn btn-danger btn-sm" href="{{ route('restaurant.removeOption', ['produitId' => $produit->id, 'optionId' => $option->id]) }}">Delete</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label for="owner_id">Owner:</label>
                                                <select name="owner_id" required class="form-control">
                                                    @foreach($owners as $owner)
                                                        <option value="{{ $owner->id }}" {{ $produit->owner_id == $owner->id ? 'selected' : '' }}>
                                                            {{ $owner->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0" {{ $produit->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $produit->status == 1 ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update Product</button>
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
      url: "{{ route('restaurant.getOptionsByFamilleOptions') }}",
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
