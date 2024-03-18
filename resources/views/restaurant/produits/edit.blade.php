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
                                <div class="card-body">
                                    <h2 class="text-center">Modifier Produit</h2>
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
                                                <input type="text" name="description" value="{{ $produit->description }}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <img id="produitImage" src="{{ asset($produit->url_image) }}" alt="Produit Image" style="width:700px;height:400px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" accept="image/*" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="prix">Prix:</label>
                                                <input type="text" name="prix" value="{{ $produit->prix }}" class="form-control"                                                 required pattern="^\d+(\.\d{1,2})?$" 			
									           title="Veuillez entrer un nombre valide avec jusqu'à deux décimales (par exemple, 9,90)">
                                            </div>
                                            <div class="form-group">
                                                <label for="categorie_id">Categorie:</label>
                                                <select name="categorie_id" required class="form-control">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"  {{ $produit->categorie_rest_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
    <label for="famille_options"> Familles d'Options correspondants:</label>
    @foreach ($familleOptions as $familleOption)
            <div class="form-check">
                <input type="checkbox" name="famille_options[]" class="form-check-input" value="{{ $familleOption->id }}" id="famille_option_{{ $familleOption->id }}" {{ in_array($familleOption->id, $produit->familleOptions->pluck('id')->toArray()) ? 'checked' : '' }} onchange="updateChildTable()">
                <label class="form-check-label" for="famille_option_{{ $familleOption->id }}">{{ $familleOption->nom_famille_option }}</label>
            </div>
        @endforeach
</div>
											<div class="table-responsive">
                                   <h6 class="mb-4">Trie de familles d'options</h6> 
                                    <table class="table table-bordered text-center" id="childProductsTable" style="border-radius: 10px; overflow: hidden;">
                                        <input type="hidden" name="child_ids" id="childIdsInput" value="">
                                        <input type="hidden" name="temporary_order" id="temporaryOrderInput" value="">
                                            <thead>
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Désignation</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($currentOptions->sortBy('RowN') as $childProduct)
                                               
                                                <tr id="childProductRow_{{ $childProduct->id_familleoptions_rest  }}">
                                                    <td>
                                                        <button class="btn btn-link btn-sm" onclick="moveRow('{{ $childProduct->id_familleoptions_rest  }}', 'up')">&#9650;</button>
                                                        {{ $temporaryOrder[$childProduct->id_familleoptions_rest ] }}
                                                        <button class="btn btn-link btn-sm" onclick="moveRow('{{ $childProduct->id_familleoptions_rest  }}', 'down')">&#9660;</button>
                                                    </td>
                                                    <td>
                                                        {{-- Check if the product exists before accessing its properties --}}
                                                        @php  
                                                            $childproduct = App\Models\familleOptionsRestaurant::find($childProduct->id_familleoptions_rest ); 
                                                        @endphp

                                                        {{ optional($childproduct)->nom_famille_option }} <br>
                                                    
                                                       
                                                    </td>


                                                   
                                                    
                                                   
                                                    

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
										
                                           
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0" {{ $produit->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    <option value="1" {{ $produit->status == 1 ? 'selected' : '' }}>Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Mettre à jour le produit</button>
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
   <script>
                                var temporaryOrder = [];

                                function moveRow(childProductId, direction) {
                                    var currentRow = document.getElementById('childProductRow_' + childProductId);
                                    var targetRow = direction === 'up' ? currentRow.previousElementSibling : currentRow.nextElementSibling;

                                    if (!targetRow) {
                                        return;
                                    }

                                    swapRows(currentRow, targetRow);
                                    updateRowPositions();
                                }

                                function swapRows(row1, row2) {
                                    var parent = row1.parentNode;
                                    var clone1 = row1.cloneNode(true);
                                    var clone2 = row2.cloneNode(true);
                                    parent.replaceChild(clone1, row2);
                                    parent.replaceChild(clone2, row1);
                                }

                                function updateRowPositions() {
                                    var rows = document.querySelectorAll('#childProductsTable tbody tr');
                                    rows.forEach(function (row, index) {
                                        var childProductId = row.id.split('_')[1];
                                        if (temporaryOrder[childProductId] !== null) {
                                            temporaryOrder[childProductId] = index + 1;
                                            row.children[0].innerHTML = `
                                                <button class="btn btn-link btn-sm" onclick="moveRow('${childProductId}', 'up')" ${index === 0 ? 'disabled' : ''}>&#9650;</button>
                                                ${temporaryOrder[childProductId] || ''}
                                                <button class="btn btn-link btn-sm" onclick="moveRow('${childProductId}', 'down')" ${index === rows.length - 1 ? 'disabled' : ''}>&#9660;</button>
                                            `;
                                        }
                                    });

                                    temporaryOrder = Object.fromEntries(
                                        Object.entries(temporaryOrder).filter(([key, value]) => value !== null)
                                    );

                                    document.getElementById('childIdsInput').value = JSON.stringify(Object.keys(temporaryOrder));
                                    document.getElementById('temporaryOrderInput').value = JSON.stringify(temporaryOrder);
                                }

                                updateRowPositions();

                           function updateChildTable() {
    var selectedOptions = document.querySelectorAll('input[name="famille_options[]"]:checked');
console.log('selectedOptions', selectedOptions);
    var tableBody = document.getElementById('childProductsTable').querySelector('tbody');
    tableBody.innerHTML = '';

    selectedOptions.forEach(function (selectedOption, index) {
        var newRow = document.createElement('tr');
        var childProductId = selectedOption.value;

        temporaryOrder[childProductId] = index + 1;

        newRow.id = 'childProductRow_' + childProductId;
        newRow.innerHTML = `
            <td>
                <button class="btn btn-link btn-sm" onclick="moveRow('${childProductId}', 'up')" ${index === 0 ? 'disabled' : ''}>&#9650;</button>
                ${temporaryOrder[childProductId] || ''}
                <button class="btn btn-link btn-sm" onclick="moveRow('${childProductId}', 'down')" ${index === selectedOptions.length - 1 ? 'disabled' : ''}>&#9660;</button>
            </td>
            <td>${selectedOption.nextElementSibling.textContent} <br></td>
        `;

        tableBody.appendChild(newRow);
    });

    updateRowPositions();
}


</script>
@endsection
