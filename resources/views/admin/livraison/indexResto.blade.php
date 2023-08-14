
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
                      <h4 class="text-center">Restaurants</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Recherhcher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> ID </th>
                              <th> Nom </th>
                              <th> N° Mode Livraison </th>
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $userLivraisonMethod)
                                <tr>
                                  <td>{{ $userLivraisonMethod->id }}</td>
                                  <td>{{ $userLivraisonMethod->name }}</td>
                                  <td>{{ $userLivraisonMethod->livraisonMethods->count() }}</td>
                                  <td><a href="{{ route('admin.restaurant.livraison.create', ['user_id' => $userLivraisonMethod->id]) }}" class="btn btn-success">Ajouter</a></td>
                                  <td>
                                    <td><a href="{{ route('admin.restaurants.details', ['restaurant' => $userLivraisonMethod->id]) }}" class="btn btn-primary">Details</a></td>
                                </td>
                                </tr>
                              @endforeach
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                          </div>
                          <div class="text-start">
                            {{ $users->links('vendor.pagination.bootstrap-5') }}
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