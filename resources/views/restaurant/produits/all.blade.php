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
                                    <h4 class="card-title">Produits</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                                            placeholder="Search for names.." title="Type in a name">
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table" id="myTable" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Nom</th>
                                                    <th>Description</th>
                                                    <th>Prix</th>
                                                    <th>Categorie</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($produits as $produit)
                                                    @include('restaurant.produits._edit-product', ['produit' => $produit])
                                                @endforeach
                                                <tr>
                                                    <td colspan="8"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                            <div class="text-end">
                                                <a href="{{ route('restaurant.produits.create') }}"
                                                    class="btn btn-primary">Create Product</a>
                                            </div>
                                            <div class="text-start">
                                                {{ $produits->links('vendor.pagination.bootstrap-5') }}
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
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" action="{{ route('restaurant.produits.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" id="productId">
                        <!-- Add other product fields here -->
                        <div class="form-group">
                            <label for="product_name">Name</label>
                            <input type="text" class="form-control" id="product_name" name="nom_produit">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Description</label>
                            <textarea class="form-control" id="product_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Price</label>
                            <input type="number" class="form-control" id="product_price" name="prix">
                        </div>
                        <div class="form-group">
                            <label for="product_category">Category</label>
                            <select class="form-control" id="product_category" name="categorie_id">
                                <!-- Populate the options for categories here -->
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_image">Image</label>
                            <input type="file" class="form-control" id="product_image" name="url_image" value="{{ asset($produit->url_image) }}">
                        </div>
                        <div class="form-group">
                            <label>Existing Image</label><br>
                                <img src="{{ asset($produit->url_image) }}" alt="Product Image" style="max-height: 200px;">
                        </div>
                        <!-- Add other product fields here -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="imagePreview" src="#" alt="Product Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script>
      $(document).ready(function() {
    $('.select-btn').click(function() {
        var productId = $(this).data('product');
        var productName = $(this).closest('tr').find('td:nth-child(2)').text();
        var productDescription = $(this).closest('tr').find('td:nth-child(3)').text();
        var productImageUrl = $(this).closest('tr').find('img').attr('src');

        // Populate the modal with product information
        $('#productId').val(productId);
        $('#product_name').val(productName);
        $('#product_description').val(productDescription);
        $('#product_image_url').val(productImageUrl);

        // Show the modal
        $('#productModal').modal('show');
    });

    // Handle form submission
    $('#addProductForm').submit(function(e) {
            var product_name = $('#product_name').val();
            var product_description = $('#product_description').val();
            var category = $('#product_category').val();
            var price = $('#product_price').val();
            var product_image_url = $('#product_image').val();

        // Perform AJAX request to add the product to the user's list
        $.ajax({
            type: 'POST',
            url: "{{ route('restaurant.produits.store') }}", // Replace with your route URL for adding categories
            data: {
                _token: "{{ csrf_token() }}",
                nom_produit: product_name,
                description: product_description,
                url_image: product_image_url,
                prix: price,
                categorie_id: category
            },
            success: function(response) {
                // Handle success response
                alert('Produit ajouté avec succès');
                // Redirect to the product list page
                window.location.href = '{{ route('restaurant.produits.index') }}';
            },
            error: function(response) {
                // Handle error response
                alert('Failed to add the product. Please try again.');
            }
        });
    });
});

    </script>
@endsection
