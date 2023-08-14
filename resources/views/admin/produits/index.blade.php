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
                                    <h2 class="text-center">Produits</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms .." title="Type in a name">
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

                                                    <th colspan="3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($produits as $produit)
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
                                                        

                                                        <td style="display: flex;">
                                                            <a href="{{ route('admin.produits.edit', $produit->id) }}"
                                                                class="btn btn-primary">Modifier</a>
                                                            <form
                                                                action="{{ route('admin.produits.destroy', $produit->id) }}"
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
                                            <a href="{{ route('admin.produits.create') }}" class="btn btn-primary">Ajouter Produit </a>
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
      $(document).ready(function() {
    $('.status-toggle-btn').click(function() {
        var button = $(this); // Store the button element reference

        var productId = button.data('id');
        var currentStatus = button.data('status');
        var newStatus = (currentStatus == 1) ? 0 : 1; // Toggle the status

        // Send AJAX request to update the status
        $.ajax({
            url: '/admin/update-status',
            type: 'POST',
            data: {
                productId: productId,
                newStatus: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update the button text and data attribute
                if (newStatus == 1) {
                    button.removeClass('btn-danger').addClass('btn-success').text('Active');
                } else {
                    button.removeClass('btn-success').addClass('btn-danger').text('Inactive');
                }
                button.data('status', newStatus);
            },
            error: function(xhr, status, error) {
                // Handle the error if needed
                console.log(error);
            }
        });
    });
});

    </script>
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
    </script>
@endsection
