@extends('base')

@section('title', 'Welcome')

@section('content')
<head>
<meta charset="utf-8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
</head>
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
                              @include('restaurant.stat')
                      <div class="card-body">
                                    <h2 class="text-center">Produits</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
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
                                                    <th colspan="3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $produit)
                                                    <tr>
                                                        <td>
                                                       
                                                            <a href="{{ asset($produit->url_image) }}"
                                                                data-toggle="modal" data-target="#imageModal">
                                                                <img src="{{ asset($produit->url_image) }}"
                                                                    alt="Product Image" class="zoomable-image">
                                                            </a>
                                                        </td>
                                                        <td>{{ $produit->nom_produit }}</td>
                                                        <td>{{ $produit->description }}</td>
                                                        <td>{{ $produit->prix }}</td>
                                                        <td>{{ $produit->categories->name }}</td>

                                                       
                                                       
                                                        <td> 
        <button class="select-btn btn {{ $produit->status ? 'btn-success' : 'btn-danger' }}" 
                data-product="{{ $produit->id }}" 
                data-selected="{{ $produit->status ? 'Actif' : 'Non Actif' }}">
            {{ $produit->status ? 'Actif' : 'Non Actif' }}
        </button>
   
    </td>
                                              
                                                            
                                                      
                                                            <td style="display: flex;">
                                                            <a href="{{ route('restaurant.produits.edit', $produit->id) }}"
                                                                 class="btn btn-primary">Modifier</a>
                                                            <form
                                                                action="{{ route('restaurant.produits.destroy', $produit->id) }}"
                                                                method="POST" style="margin-left:15px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger col">Supprimer</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr><td colspan="8"></td></tr>
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                          <div class="text-end">
                                           <a href="{{ route('restaurant.produits.create') }}" class="btn btn-primary">Créer un produit</a>
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

    <style>
        .zoomable-image {
            cursor: pointer;
            max-width: 100%;
            height: auto;
        }

        .modal-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: auto;
        }

    </style>

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







<!-- Rest of your HTML code remains the same -->

    <script>
    $(function () {
        $('.select-btn').click(function () {
            var button = $(this);
            var status = button.data('Actif') === 'Actif' ? 0 : 1; // Toggle the status

            var produit_id = button.data('product');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/status/update',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'product_id': produit_id
                },
                success: function (data) {
                    if (status == 1) {
                        button.removeClass('btn-danger').addClass('btn-success').text('Actif');
                        button.data('Actif', 'Actif');
                    } else {
                        button.removeClass('btn-success').addClass('btn-danger').text('Non Actif');
                        button.data('Actif', 'Non Actif');
                    }
                    console.log(data.success);
                }
            });
        });
    });
</script>
@endsection
