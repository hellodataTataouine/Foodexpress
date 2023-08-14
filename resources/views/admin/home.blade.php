
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
                      <h4 class="card-title">Restaurants</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:100%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> ID </th>
                              <th> Nom </th>
                              <th> N° Télp </th>
                              <th> Adresse </th>
                              <th> URL Platform </th>
                              <th> N° Des Produits</th>
                              <th> N° Des Commandes </th>
                              <th> Montant Dernier Commande </th>
                              <th> Date Dernier Commande</th>
                              <th> Horaire</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($clients as $clientInfo)
                                <tr>
                                  <td>{{ $clientInfo->id }}</td>
                                  <td>{{ $clientInfo->name }}</td>
                                  <td>{{ $clientInfo->contact }}</td>
                                  <td>{{ $clientInfo->localisation }}</td>
                                  <td>{{ $clientInfo->url_platform }}</td>
                                  <td>{{ $clientInfo->products_count > 0 ? $clientInfo->products_count : 0 }}</td>
                                  <td>  
                                    <?php
                                      $orderCount = DB::table('cart_user')
                                          ->where('restaurant_id', $clientInfo->id)
                                          ->count();
                                      echo $orderCount;
                                    ?> 
                                  </td>
                                  <td>
                                    <?php
                                        $lastOrder = DB::table('cart_user')
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
                                  <td> <a href="{{ route('admin.horaires.index', ['id' => $clientInfo->id]) }}" class="btn btn-warning">Horaires</a>
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