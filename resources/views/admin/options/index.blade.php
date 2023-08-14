
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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Liste des Options</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher pa noms.." title="Type in a name">
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="myTable" class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom Option</th>
                                                    <th>Famille Option</th>
                                                    <th>Prix</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($options as $option)
                                                    <tr>
                                                        <td>{{ $option->id }}</td>
                                                        <td>{{ $option->nom_option }}</td>
                                                        <td>{{ $option->familleOption->nom_famille_option }}</td>
                                                        <td>{{ $option->prix }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.options.edit', $option->id) }}" class="btn btn-primary">Modifier</a>
                                                      
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeOption({{ $option->id }})">Supprimer</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                          <div class="text-end">
                                            <a href="{{ route('admin.options.create') }}" class="btn btn-primary">Ajouter Option</a>
                                          </div>
                                          <div class="text-start">
                                            {{ $options->links('vendor.pagination.bootstrap-5') }}
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Product Image" class="modal-image">
                </div>
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
function removeOption(optionId) {
    if (confirm('Are you sure you want to remove this option?')) {
        window.location.href = "{{ route('admin.options.remove', '') }}/" + optionId;
    }
}
    </script>
@endsection
