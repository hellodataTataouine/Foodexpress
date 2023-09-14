
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
                      <h4 class="card-title">Restaurants</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                             
                              <th> Nom </th>
                            
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($livraisonMethods as $LivraisonMethod)
                                <tr>
                                  @php
                                  $livraisonType = \App\Models\LivraisonMethod::find($LivraisonMethod->livraison_id);
                              @endphp
                                  <td>{{ $livraisonType->methode }}</td>
                                 
                                 <!-- <td><a  href="{{ route('restaurant.livraison.edit', ['id' => $LivraisonMethod->id]) }}"  class="btn btn-primary">Modifier</a></td>-->
                                  
                                 
                                    <td><form action="{{ route('restaurant.livraison.destroy', $LivraisonMethod) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Supprimer</button>
                                  </form></td>
                               
                                </tr>
                              @endforeach
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>

                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('restaurant.livraison.create') }}" class="btn btn-primary mb-3">Ajouter  </a>
                          </div>
                          <div class="text-start">
                            {{ $livraisonMethods->links('vendor.pagination.bootstrap-5') }}
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