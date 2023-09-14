<style>

 ul.product-list-dark {
    list-style-type: none;
    padding: 0;
}

ul.product-list-dark li {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #ffffff; /* Dark background color */
    border: 1px solid #555; /* Dark border color */
    color: #000000; /* Light text color */
    
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
                      <h4 class="card-title">All Commandes</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
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
                              <th class="col-md-1"> Statut  </th>
                             
                            </tr>
                          </thead>
                          <tbody>
                          @forelse ($commandes as $commande)
            <tr>
                
                <td>{{ $commande->clientfirstname }}</td>
                <td>
                    <!-- Nested loop for products and their options -->
                    <ul class="product-list-dark">
                      @foreach ($commande->cartDetails as $cartDetail)
                          <li>
                            @if($cartDetail->produit != null)
                              <strong> {{ $cartDetail->produit->nom_produit }} :</strong>
                              <strong>Options:</strong>
                              {{ $cartDetail->optionsdetails }}
                              @endif
                             
                        
                          </li>
                      @endforeach
                  </ul>
                </td>
                <td>{{ $commande->prix_total }}</td>
                @if ($commande->mode_livraison == 1)
                    <td>Sur place</td>
                @else
                    <td>A domicile</td>
                @endif

              
                @if ($commande->methode_paiement == 1)
                    <td>Espece</td>
                @else
                    <td>Carte Bancaire</td>
                @endif

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
            

            <!-- Nested loop for products and their options-->
            <!-- Nested loop for products and their options-->
   
        @empty
            <!-- This will be displayed if $commandes is empty -->
            <tr>
                <td colspan="7">No commands found.</td>
            </tr>
        @endforelse
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                          </div>
                          <div class="text-start">
                            {{ $commandes->links('vendor.pagination.bootstrap-5') }}
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