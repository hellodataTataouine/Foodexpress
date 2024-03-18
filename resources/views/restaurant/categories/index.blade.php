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
                          
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Order</th>
									 <th>Image</th>
                                    <th>Nom</th>
                                    <th>Date de Création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($categories->sortBy('RowN') as $category)
                                     <tr data-category-id="{{ $category->id }}">
                                        <td>
                                          <i class="fa-solid fa-arrow-up" onclick="moveRowUp(this)" data-disabled="true"></i>
                                          {{ $category->RowN }}
                                          <i class="fa-solid fa-arrow-down" onclick="moveRowDown(this)" data-disabled="true"></i>
											</td>	
										<td>
                                                       
                                                            <a href="{{ asset($category->url_image) }}"
                                                                data-toggle="modal" data-target="#imageModal">
                                                                <img src="{{ asset($category->url_image) }}"
                                                                    alt="Product Image" class="zoomable-image">
                                                            </a>
                                                        </td>	
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td style="display: flex; justify-content: space-between;">
                                                   
                                        <a href="{{ route('restaurant.category.show',  $category->id) }}" class="btn btn-success btn-sm">liste Produits</a>
                                       
                                          <a href="{{ route('restaurant.produits.create', ['category_id' => $category->id]) }}" class="btn btn-success btn-sm">Ajouter Produit</a>
                                            <a href="{{ route('restaurant.categories.edit', $category) }}" class="btn btn-primary btn-sm col-s">Modifier</a>
                                            <form action="{{ route('restaurant.categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('restaurant.categories.create') }}" class="btn btn-primary mb-3">Ajouter Categorie</a>
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
         <script>
        const images = document.querySelectorAll('.zoomable-image');
        const modalImage = document.querySelector('.modal-image');

        images.forEach(function(image) {
            image.addEventListener('click', function() {
                const imageUrl = image.getAttribute('src');
                modalImage.setAttribute('src', imageUrl);
            });
        });

        $('#imageModal').on('hidden.bs.modal', function() {
            modalImage.setAttribute('src', '');
        });

    </script>
       <script>
function moveRowUp(row) {
    var currentRow = row.parentNode.parentNode;
    if (currentRow.rowIndex === 1) {
        return;
    }
    var previousRow = currentRow.previousElementSibling;
    swapRows(currentRow, previousRow);
    updateRowPositions();
}

function moveRowDown(row) {
    var currentRow = row.parentNode.parentNode;
    var nextRow = currentRow.nextElementSibling;
    if (nextRow === null) {
        return;
    }
    swapRows(currentRow, nextRow);
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
    var rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row, index) {
        //var categoryName = row.querySelector('.category-name').textContent;
        var categoryId = row.getAttribute('data-category-id');
        var rowN = index + 1;
        // Send an AJAX request to update the RowN property in your database
        updateCategoryRowN(categoryId, rowN);
    });
    location.reload();
}

function updateCategoryRowN(categoryId, rowN) {
  
    $.ajax({
        url: '/update-category-row-n',
        method: 'POST',
        data: { categoryId: categoryId, rowN: rowN,  _token: "{{ csrf_token() }}", },
        success: function(data) {
            if (data.success) {
              
                // Success: Show a success message or perform any other action
                console.log('RowN updated successfully.');
            } else {
                // Handle other success scenarios or messages
                console.log('Update was successful but with a different message: ' + data.message);
            }
        },
        error: function(err) {
            // Error: Handle the error response and show an error message
            console.error('An error occurred while updating RowN:', err);
            alert('Error: Unable to update RowN. Please try again.');
        }
    });
}



      function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        var found = false; // Flag to check if the search term is found in any cell of the row
        for (var j = 1; j < tr[i].cells.length; j++) { // Start from the second cell to skip the image cell
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break; // If found in any cell, break the inner loop
                }
            }
        }
        if (found) {
            tr[i].style.display = ""; // Show the row
        } else {
            tr[i].style.display = "none"; // Hide the row
        }
    }
}
            </script>
     @endsection