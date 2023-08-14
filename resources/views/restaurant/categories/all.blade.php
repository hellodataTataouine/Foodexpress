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
                                    <h4 class="card-title">Categories</h4>
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
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Date Creation</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr data-category-id="{{ $category->id }}">
                                                        <td>{{ $category->id }}</td>
                                                        <td class="category-name">{{ $category->name }}</td>
                                                        <td>{{ $category->date_creation }}</td>
                                                        <td style="display: flex; justify-content: space-between;">
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                onclick="openModal({{ $category->id }}, '{{ $category->name }}')">Add
                                                                this Category</button>
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
                                                <a href="{{ route('restaurant.categories.create') }}"
                                                    class="btn btn-primary mb-3">Ajouter Categorie</a>
                                            </div>
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
                    <input type="hidden" id="categoryId">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAddCategory()">Add Category</button>
                </div>
            </div>
        </div>
    </div>

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
            $('#categoryId').val(categoryId);
            $('#categoryName').val(categoryName);
            $('#categoryModal').modal('show');
        }

        function confirmAddCategory() {
            var categoryId = $('#categoryId').val();
            var categoryName = $('#categoryName').val();

            // Update the category name in the table
            var categoryRow = $('tr[data-category-id="' + categoryId + '"]');
            categoryRow.find('.category-name').text(categoryName);
            // Submit the form to add the category via AJAX
            $.ajax({
                url: "{{ route('restaurant.categories.store') }}", // Replace with your route URL for adding categories
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: categoryName
                },
                success: function(response) {
                    // Redirect to the list of categories
                    window.location.href = "{{ route('restaurant.categories.index') }}"; // Replace with your route URL for the category list
                },
                error: function() {
                    // Handle error if the category cannot be added
                    alert('Failed to add the category. Please try again.');
                }
            });

            // Close the modal
            $('#categoryModal').modal('hide');
        }

    </script>
@endsection
