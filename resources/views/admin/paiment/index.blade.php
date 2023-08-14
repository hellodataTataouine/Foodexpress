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
                      <h4 class="card-title">Paiment</h4>
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
                                    <th>ID</th>
                                    <th>Methode De Paiement</th>
                                    <th>Date Creation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paimentMethods as $paimentMethod)
                                    <tr>
                                        <td>{{ $paimentMethod->id }}</td>
                                        <td>{{ $paimentMethod->type_methode }}</td>
                                        <td>{{ $paimentMethod->created_at }}</td>
                                        <td style="display: flex; justify-content: space-between;">
                                          <a href="{{ route('admin.produits.create', ['paimentMethod_id' => $paimentMethod->id]) }}" class="btn btn-success btn-sm">Ajouter a Restaurant</a>
                                            <a href="{{ route('admin.paiment.edit', $paimentMethod) }}" class="btn btn-primary btn-sm col-s">Edit</a>
                                            <form action="{{ route('admin.paiment.destroy', $paimentMethod) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Are you sure you want to delete this paimentMethod?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('admin.paiment.create') }}" class="btn btn-primary mb-3">Ajouter Paiement Methode</a>
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