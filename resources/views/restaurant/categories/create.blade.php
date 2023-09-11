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
                                    <h2 class="text-center">Ajouter Categorie</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                                               placeholder="Search for names.." title="Type in a name">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Date de Création</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($categories as $category)
                                                <tr data-category-id="{{ $category->id }}">
                                                    <td>{{ $category->id }}</td>
                                                    <td class="category-name"
                                                        value="{{ $category->name }}">{{ $category->name }}</td>
                                                    <td>{{ $category->date_creation }}</td>
                                                    <td style="display: flex; justify-content: space-between;">
                                                        <button type="button" class="btn btn-success btn-sm"
                                                                onclick="openModal({{ $category->id }}, '{{ $category->name }}')">
                                                            Ajouter Cette Categorie
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                            <div class="text-end">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                                onclick="openModalAddcategory">
                                                                Ajouter une catégorie 
                                                        </button>
                                                    </div>

                                           <!-- <div class="text-end">
                                                <a href="{{ route('restaurant.categories.create') }}"
                                                   class="btn btn-primary mb-3">Ajouter une categorie spécifique</a>
                                            </div>-->
                                            <div class="text-start">
                                                {{ $categories->links('vendor.pagination.bootstrap-5') }}
                                            </div>
                                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryNameInput" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryNameInput">
                    </div>
                    <div id="productCheckboxes"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAddCategory()">Add Category</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="specifiquecategoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Ajouter une categorie spécifique</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input field for "nom de categorie" -->
                    <div class="form-group">
                        <label for="categoryName">Nom de categorie:</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Nom de categorie">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="saveCategory()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function openModal(categoryId, categoryName) {
            $('#categoryNameInput').val(categoryName);
            $('#categoryId').val(categoryId);
            $('#categoryName').val(categoryName);

            $.ajax({
                url: "{{ route('fetch.products') }}",
                type: "GET",
                data: {categoryId: categoryId},
                success: function (response) {
                    var productCheckboxes = '';
                    response.products.forEach(function (product) {
                        var checked = product.selected ? 'checked' : '';
                        productCheckboxes += '<div class="form-check">';
                        productCheckboxes += '<input class="form-check-input" type="checkbox" name="products[]" value="' + product.id + '" ' + checked + '>';
                        productCheckboxes += '<input type="text" class="form-control" name="nom_produit[]" value="' + product.nom_produit + '" placeholder="nom produit">';
                        productCheckboxes += '<input type="text" class="form-control" name="descriptions[]" value="' + product.description + '" placeholder="Description">';
                        productCheckboxes += '<input type="text" class="form-control" name="id_produit[]" value="' + product.id + '"  style="display:none;" >';
                        productCheckboxes += '<input type="text" class="form-control" name="image_urls[]" value="' + product.url_image + '" style="display:none;" >';
                        productCheckboxes += '<input type="text" class="form-control" name="prices[]" value="' + product.prix + '" placeholder="Price">';
                        productCheckboxes += '</div>';
                    });

                    $('#productCheckboxes').html(productCheckboxes);

                    $('#categoryModal').modal('show');
                },
                error: function () {
                    alert('Failed to fetch products. Please try again.');
                }
            });
        }


        function confirmAddCategory() {
            var categoryId = $('#categoryId').val();
            var categoryName = $('#categoryNameInput').val();

            var checkedProducts = $('input[name="products[]"]:checked').map(function () {
                return {
                    id_produit: $(this).siblings('input[name="id_produit[]"]').val(),
                    nom_produit: $(this).siblings('input[name="nom_produit[]"]').val(),
                    description: $(this).siblings('input[name="descriptions[]"]').val(),
                    url_image: $(this).siblings('input[name="image_urls[]"]').val(),
                    prix: $(this).siblings('input[name="prices[]"]').val(),
                    categorie_id: categoryId
                };
            }).get();

            var formData = {
                _token: "{{ csrf_token() }}",
                categoryId: categoryId,
                categoryName: categoryName,
                products: checkedProducts
            };

            $.ajax({
                url: "{{ route('restaurant.categories.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    console.log(response);
                    window.location.href = "{{ route('restaurant.categories.index') }}";
                },
                error: function () {
                    alert(' This category already exists in your categories list.');
                }
            });

            $('#categoryModal').modal('hide');
        }

      

        function openModalAddCategory() {
        // Show the modal
        $('#specifiquecategoryModal').modal('show');
    }
    function saveCategory() {
        // Retrieve the category name from the input field
        var categoryName = document.getElementById("categoryName").value;

        
        
        // Close the modal
        var categoryModal = new bootstrap.Modal(document.getElementById("categoryModal"));
        categoryModal.hide();
    }
    </script>
@endsection
