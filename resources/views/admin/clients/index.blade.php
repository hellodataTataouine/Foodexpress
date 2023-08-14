
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
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h2 class="text-center">Liste des Restaurants</h2>
                      @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                      @endif
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="max-width:100%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> Logo </th>
                              <th> Nom </th>
                              <th> N° Tél </th>
                              <th> Adresse </th>
                              <th> URL Platform </th>
                              <th> N° Des Produits</th>
                              <th> N° Des Commandes </th>
                              <th> Montant Dernier Commande </th>
                              <th> Date Dernier Commande</th>
                              <th>Status</th>
                          
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($clients as $clientInfo)
                                <tr>
                                  <td>
                                    <a href="{{ asset($clientInfo->logo) }}"
                                        data-toggle="modal" data-target="#imageModal">
                                        <img src="{{ asset($clientInfo->logo) }}"
                                            alt="Product Image" class="zoomable-image">
                                    </a>
                                </td>
                                  
                                  <td>{{ $clientInfo->name }}</td>
                                  <td>{{ $clientInfo->phoneNum1}}</td>
                                  <td>{{ $clientInfo->localisation }}</td>
                                  <td>{{ $clientInfo->url_platform }}</td>
                                  <td>{{ $clientInfo->products_count > 0 ? $clientInfo->products_count : 0 }}</td>
                                  <td>  
                                    <?php
                                      $orderCount = DB::table('commands')
                                          ->where('restaurant_id', $clientInfo->id)
                                          ->count();
                                      echo $orderCount;
                                    ?> 
                                  </td>
                                  <td>
                                    <?php
                                        $lastOrder = DB::table('commands')
                                            ->where('restaurant_id', $clientInfo->id)
                                            ->orderBy('created_at', 'desc')
                                            ->first();
                        
                                        if ($lastOrder) {
                                            echo $lastOrder->prix_total;
                                        } else {
                                            echo 'N/A';
                                        }
                                    ?>
                                  </td>
                                 
                                  <td>
                                      <?php
                                          if ($lastOrder) {
                                              echo $lastOrder->created_at;
                                          } else {
                                              echo 'N/A';
                                          }
                                      ?>
                                  </td>
                                  <td>
                                    <button class="btn update-status-btn {{ $clientInfo->status == 1 ? 'btn-success' : 'btn-danger' }}" data-id="{{ $clientInfo->id }}">
                                        <span id="status_{{ $clientInfo->id }}">{{ $clientInfo->status == 1 ? 'active' : 'inactive' }}</span>
                                    </button>
                                </td> 
                                  <td>
                                    <a href="{{ route('admin.clients.edit', ['id' => $clientInfo->id]) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('admin.clients.destroy', ['id' => $clientInfo->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                  </td>
                                </tr>
                              @endforeach
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a aling="rigth" href="{{ url('admin/clients/create') }}" class="btn btn-primary mb-2">Ajouter Restaurant</a>
                          </div>
                          <div class="text-start">
                            {{ $clients->links('vendor.pagination.bootstrap-5') }}
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
        $(document).ready(function() {
            // Handle the button click event
            $('.update-status-btn').click(function() {
                var button = $(this);
                var clientInfo = button.data('id');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '{{ route("admin.clients.updateStatus", ":id") }}'.replace(':id', clientInfo),
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Update the status displayed in the button after the status is updated
                        var newStatus = response.newStatus;
                        var statusSpan = button.find('#status_' + clientInfo);
                        statusSpan.text(newStatus == 1 ? 'active' : 'inactive');
                        // Update the button class to change its color based on the new status
                        button.removeClass('btn-success btn-danger');
                        button.addClass(newStatus == 1 ? 'btn-success' : 'btn-danger');
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred during the AJAX request.');
                    }
                   })});
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