
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
                      <h2 class="text-center">Users</h2>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th>Restaurant</th>
                                  <th>Email</th>
          
                               
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($users as $user)
                                  <tr>
                                      <td>{{ $user->name }}</td>
                                      <td>{{ $user->email }}</td>
                           
                                     
                                                       
                                                    
      <!--  <button 
class="select-btn btn {{ $user->status ? 'btn-success' : 'btn-danger' }}" type="checkbox
                data-product="{{ $user->id }}" 
                data-selected="{{ $user->status ? 'selected' : 'not-selected' }}">
            {{ $user->status ? 'active' : 'inactive' }}
        </button>
 
    </td>-->
                                      <td>
                                          <a href="{{ route('admin.users.edit',  $user->id) }}" class="btn btn-primary">Modifier</a>
                                         
                                         
                                         
                                          <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger"   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                    
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ url('/admin/users/create') }}" class="btn btn-primary">Ajouter un Utilisateur</a>
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