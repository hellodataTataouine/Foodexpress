
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
                      <h4 class="text-center"> liste des appareille connecter</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> N° Imei </th>
                              <th> N° Série </th>
                              <th> Date service </th>
                              <th> Restaurant</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                                <tr>                 
                                @foreach ($imeirestaurant as $resto)
                                  <td>{{ $resto->numimei }}</td>
                                  <td>{{ $resto->N_Serie }}</td>
                                  <td>{{ $resto->Date_Service }}</td>
                                  <td>{{ $resto->restaurant->name }}</td>
                                  <td  style="display: flex;">
                                    <a href="{{ route('admin.imei.edit', $resto->id) }}" class="btn btn-primary">Modifier</a>
                                    <form action="{{ route('admin.imei.destroy',$resto->id)}}" method="POST" style="margin-left:15px;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
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
                                            <a href="{{ url('/admin/Imei/create') }}" class="btn btn-primary">Ajouter  </a>
                                          </div>
                                          <div class="text-start">
                                            {{ $imeirestaurant->links('vendor.pagination.bootstrap-5') }}
                                          </div>
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