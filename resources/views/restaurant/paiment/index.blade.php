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
                      <h4 class="card-title">Paiment</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                          
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="rechercher" title="Taper nom méthode">
                    </div>
                      <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                  
                                    <th>Methode De Paiement</th>
                                    <th>client_id</th>
                                    <th>client_secret</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paimentMethods as $paimentMethod)
                                    <tr>
                                      @php
                                      $paimentType = \App\Models\PaimentMethod::find($paimentMethod->paiment_id);
                                  @endphp
                                        <td>{{ $paimentType->type_methode }}</td>
                                      
                                        <td>{{ $paimentMethod->client_id }}</td>
                                        <td>{{ $paimentMethod->client_secret }}</td>
                                        <td style="display: flex; justify-content: space-between;">
                                          @if($paimentType->type_methode == "PayPal" || $paimentType->type_methode == "Carte Bancaire" )
                                          <a href="{{ route('restaurant.paiment.edit', ['id' => $paimentMethod->id]) }}" class="btn btn-primary btn-sm col-s">Modifier</a>
                                          @endif

                                            <form action="{{ route('restaurant.paiment.destroy', $paimentMethod->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce Méthode de paiement?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('restaurant.paiment.create') }}" class="btn btn-primary mb-3">Ajouter  </a>
                          </div>
                          <div class="text-start">
                            {{ $paimentMethods->links('vendor.pagination.bootstrap-5') }}
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