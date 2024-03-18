
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
                                    <h2 class="text-center">Liste des Options</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par nom.." title="Type in a name">
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="myTable" class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                               
                                                    <th>Nom Option</th>
                                                    <th>Famille Option</th>
                                                    <th>Prix</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($options as $option)
                                                    <tr>
                                                      
                                                        <td>{{ $option->nom_option }}</td>
                                                        <td>{{ $option->familleOption->nom_famille_option }}</td>
                                                        <td>{{ $option->prix }}</td>

                                                        <td> 
                                                            <a href="{{ route('restaurant.options.edit', $option->id) }}" class="btn btn-primary">Modifier</a>
                                                      
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeOption({{ $option->id }})">Supprimer</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                          <div class="text-end">
                                            <a href="{{ route('restaurant.options.create') }}" class="btn btn-primary">Ajouter Option</a>
                                          </div>
                                          <div class="text-start">
                                          
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Product Image" class="modal-image">
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
        var found = false; // Flag to check if the search term is found in any cell of the row
        for (var j = 0; j < tr[i].cells.length; j++) { // Start from the second cell to skip the image cell
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
function removeOption(optionId) {
    if (confirm('Are you sure you want to remove this option?')) {
        window.location.href = "{{ route('restaurant.options.remove', '') }}/" + optionId;
    }
}
    </script>
@endsection
