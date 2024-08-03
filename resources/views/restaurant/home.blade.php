<style>
    ul.product-list-dark {
        list-style-type: none;
        padding: 0;
    }

    ul.product-list-dark li {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #ffffff;
        border: 1px solid #555;
        color: #000000;
    }

    .options {
        white-space: pre-wrap;
        word-wrap: break-word;
    }
	 /* Add CSS styles to create a strong border outline for table rows */
    /* Add CSS styles to create a strong border outline for table rows */
    table.table {
        border-collapse: collapse;
        width: 100%;
    }

    table.table th, table.table td {

        padding: 8px;
    }


    table.table tr {
        border: 2px solid #000; /* You can adjust the border style and color as needed */
    }

    table.table th {
        background-color: #f2f2f2; /* Optional background color for header cells */
    }

    table.table tr:hover {
        background-color: #e0e0e0; /* Optional background color for hover effect */
    }
</style>

@extends('base')

@section('title', 'Welcome')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
                      <h4 class="card-title">Tous Commandes</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher.." title="Tapez un nom">
                    </div>
                      <div class="table-responsive"  >

                        <table class="table" id="myTable">
                          <thead>
                            <tr>

                              <th class="col-md-2"> Nom Client </th>
                              <th class="col-md-4"> lignes de commande </th>
                              <th class="col-md-1"> Prix Total </th>
                              <th class="col-md-1"> Mode De Livraison </th>

                              <th class="col-md-1"> Mode De Paiement </th>
                              <th class="col-md-1"> Date  </th>
                              <th class="col-md-1"> Statut  </th>
								  <th class="col-md-1"> Action </th>

                            </tr>
                          </thead>
                          <tbody>
                       @forelse($commandes->sortByDesc('id') as $commande)
            <tr>

                <td>{{ $commande->clientfirstname }} {{ $commande->clientlastname }} || {{ $commande->clientNum1 }}</td>
<td style="max-width: 200px;">
    <!-- Nested loop for products and their options -->
    <ul class="product-list-dark">
        @foreach ($commande->cartDetails as $cartDetail)
            <li>
                @if($cartDetail->produit != null)
                    <strong>{{ $cartDetail->qte_produit }} × {{ $cartDetail->produit->nom_produit }}</strong>
				 <span class="options">
					 @if($cartDetail->optionsdetails != null)
                 <strong>Options:</strong>

                        {{ $cartDetail->optionsdetails }}
                    </span>
				@endif
                @endif
            </li>
        @endforeach
    </ul>
</td>

                <td>{{ $commande->prix_total }}</td>

                @php

                $livraison= DB::table('livraisons')->where('id',$commande->mode_livraison)->first();
                $paiement = DB::table('paiement')->where('id',$commande->methode_paiement)->first();
                @endphp


@if($livraison && $livraison->methode)
<td>{{ $livraison->methode }}</td>
@else
<td>--</td>
@endif

@if($paiement && $paiement->type_methode)
<td>{{ $paiement->type_methode }}</td>
@else
<td>--</td>
@endif


{{-- <td>{{ $commande->mode_livraison }}</td>
<td>{{$commande->methode_paiement }}</td> --}}
                   <td>{{ $commande->created_at }}</td>
                @if ($commande->statut == "Nouveau")
                <td><button type="button" class="btn btn-primary status-button" data-command-id="{{ $commande->id }}">Nouveau</button></td>

                @elseif ($commande->statut == "En Cours")
                    <td><button type="button" class="btn btn-warning  status-button" data-command-id="{{ $commande->id }}">En Cours</button></td>
                @elseif ($commande->statut == "Livrée")
                    <td><button type="button" class="btn btn-success status-button" data-command-id="{{ $commande->id }}">Livrée</button></td>

                @elseif ($commande->statut == "Annulée")
                <td><button type="button" class="btn btn-danger status-button" data-command-id="{{ $commande->id }}">Annulée</button></td>
                @else
                <td><button type="button" class="btn btn-primary status-button" data-command-id="{{ $commande->id }}">Nouveau</button></td>
            @endif
				<td><form
                                                                action="{{ route('restaurant.commandes.destroy', $commande->id) }}"
                                                                method="POST" style="margin-left:15px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger col" onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?')">Supprimer</button>
                                                            </form>
                           </td>


            <!-- Nested loop for products and their options-->
            <!-- Nested loop for products and their options-->

        @empty
            <!-- This will be displayed if $commandes is empty -->
            <tr>
                <td colspan="7">Aucune commande trouvée.</td>
            </tr>
        @endforelse
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>

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

       <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="statusForm">
                <div class="form-group">
                  <label for="newStatus">Choisir le statut:</label>
                  <select class="form-control" id="newStatus" name="newStatus">
                    <option value="Nouveau">Nouveau</option>
                    <option value="En Cours">En Cours</option>
                    <option value="Livrée"> Livrée </option>
                    <option value="Annulée">Annulée</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary"  id="changeStatusBtn"> Changer</button>
            </div>
          </div>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





<script>


  $(document).ready(function () {
    $('.status-button').on('click', function () {
      // Get the command ID from the clicked link
      const commandId = $(this).data('command-id');
      // Show the modal
      $('#statusModal').modal('show');
      // Store the command ID in the "Save Changes" button's data attribute
      $('#changeStatusBtn').data('command-id', commandId);
    });

    $('#changeStatusBtn').on('click', function () {
      // Get the command ID from the "Save Changes" button's data attribute
      const commandId = $(this).data('command-id');
      // Get the new status from the select input
      const newStatus = $('#newStatus').val();

      // Perform an AJAX request to update the status on the server
      $.ajax({
        type: 'POST', // Change this to your server's HTTP method
        url:  "{{ route('update.status') }}",    // Replace with the actual URL to update status
        data: {
          _token: "{{ csrf_token() }}",
          commandId: commandId,
          newStatus: newStatus,
          // Include any other data you need to send to the server
        },
        success: function (response) {
          // Handle success, you can update the UI or show a success message here
          console.log('Statut modifié avec succès', response);
          // Close the modal
          $('#statusModal').modal('hide');
           // Update the button's class and text based on the new status
           const button = $(`.status-button[data-command-id="${commandId}"]`);
                switch (newStatus) {
                    case 'Nouveau':
                        button.removeClass().addClass('btn btn-primary');
                        break;
                    case 'En Cours':
                        button.removeClass().addClass('btn btn-warning');
                        break;
                    case 'Livrée':
                        button.removeClass().addClass('btn btn-success');
                        break;
                    case 'Annulée':
                        button.removeClass().addClass('btn btn-danger');
                        break;
                }
                button.text(newStatus);
        },
        error: function (error) {
          // Handle error, show an error message or handle it as needed
          console.error('Error updating status:', error);
          // Close the modal
          $('#statusModal').modal('hide');
           if (error.responseJSON && error.responseJSON.message) {
            // Display the error message from the server if available
            alert('Error: ' + error.responseJSON.message);
        } else {
            // Display a generic error message if no specific message is available
            alert('An error occurred while updating the status.');
        }

        },
      });
    });
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

    $(document).ready(function () {
        $(".status-button").on("click", function () {
            var commandId = $(this).data("command-id");
            $("#statusForm").attr("data-command-id", commandId);
            $("#statusModal").modal("show");
        });

        $("#changeStatusBtn").on("click", function () {
            var newStatus = $("#newStatus").val();
            var commandId = $("#statusForm").data("command-id");

            // You can add AJAX code to update the status here

            $("#statusModal").modal("hide");
        });
    });
</script>

     @endsection
