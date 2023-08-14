
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
                      <h4 class="card-title">All Commandes</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> ID </th>
                              <th> Nom Client </th>
                              <th> lignes de commande </th>
                              <th> Prix Total </th>
                              <th> Mode De Livraison </th>
                            
                              <th> Mode De Paiement </th>
                              <th> Statut  </th>
                              <th> Modifier </th>
                            </tr>
                          </thead>
                          <tbody>
                          @forelse ($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->user->name }}</td>
                <td>
                    <!-- Nested loop for products and their options -->
                    <ul>
                        @foreach ($commande->cartDetails as $cartDetail)
                            <li>
                            <strong> Produit:</strong> {{ $cartDetail->produit->nom_produit }}
                            <strong>Options:</strong> 
                                {{$cartDetail->optionsdetails }}
                                   
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

                @if ($commande->statut == "Pending")
                    <td><button type="button" class="btn btn-warning">Pending</button></td>
                @elseif ($commande->statut == "Declined")
                    <td><button type="button" class="btn btn-danger">Declined</button></td>
                @else
                    <td><button type="button" class="btn btn-success">Success</button></td>
                @endif
             
                <td><a href="#">Modifier</a></td>
            </tr>

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