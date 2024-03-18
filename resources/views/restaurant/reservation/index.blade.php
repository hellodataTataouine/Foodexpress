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

           
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">List Reservations</h4>
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
                               
                                    
                                    <th>table</th>
                                    <th>N° personnes</th>
                                    <th>Nom|Prénom Client</th>
                                    <th>N° Tél Client</th>
									 <th>Email Client</th>
                                    <th>Heure Début</th>
                                    <th>Heure Fin</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                   
                                      <td>{{ optional($reservation->tables)->designation }}</td>
                                        <td>{{ $reservation->nbre_Personnes}}</td>
                                        <td>{{ $reservation->ClientFName . ' ' . $reservation->ClientLName }}</td>
                                        <td>{{ $reservation->ClientPhone}}  </td>
										<td>{{ $reservation->ClientEmail}}  </td>
                                        <td>{{ $reservation->heure_debut}}</td>
                                        <td>{{ $reservation->heure_fin}}</td>
                                        <td>{{ $reservation->date}}</td>
                                        @if ($reservation->statut == "Nouveau")
              <td><button type="button" class="btn btn-primary status-button" data-command-id="{{ $reservation->id }}">Nouveau</button></td>
                 
              
              @elseif ($reservation->statut == "confirmé")
                  <td><button type="button" class="btn btn-success status-button" data-command-id="{{ $reservation->id }}">Confirmé</button></td>
              
              @elseif ($reservation->statut == "Annulée")
              <td><button type="button" class="btn btn-danger status-button" data-command-id="{{ $reservation->id }}">Annulée</button></td>
              @else
              <td><button type="button" class="btn btn-primary status-button" data-command-id="{{ $reservation->id }}">Nouveau</button></td>
          @endif
                                        <td style="display: flex; justify-content: space-between;">
                                         
                                          <!--  <a href="{{ route('restaurant.resevation.edit', $reservation) }}" class="btn btn-primary btn-sm col-s">Modifier</a> -->
											  
											
                                            <form action="{{ route('restaurant.resevation.destroy', $reservation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Voulez-vous vraiment supprimer cette reservation?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('restaurant.resevation.create') }}" class="btn btn-primary mb-3">Ajouter reservation</a>
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
            <h5 class="modal-title" id="statusModalLabel">Choisir le statut:</h5>
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
                 
                  <option value="confirmé"> Confirmé </option>
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
      url:  "{{ route('update.reservationstatus') }}",    // Replace with the actual URL to update status
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
     @endsection
