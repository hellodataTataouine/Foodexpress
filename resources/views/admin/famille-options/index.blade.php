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
                                    <h4 class="card-title">Liste Familles d'Options</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="myTable" class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom Famille Option</th>
                                                    <th>Type Famille Option</th>
                                                    <th>List options</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($familleOptions as $familleOption)
                                                <tr>
                                                    <td>{{ $familleOption->id }}</td>
                                                    <td>{{ $familleOption->nom_famille_option }}</td>
                                                    <td>{{ $familleOption->type }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.famille-options.show', $familleOption->id) }}" class="btn btn-success">Options de cette Famille Option</a>
                                                       
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.options.create', ['famille_option_id' => $familleOption->id]) }}" class="btn btn-success">Ajouter Option</a>
                                                        <a href="{{ route('admin.famille-options.edit', $familleOption->id) }}" class="btn btn-primary">Modifier</a>
                                                        <form action="{{ route('admin.famille-options.destroy', $familleOption->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                            <div class="text-end">
                                                <a href="{{ route('admin.famille-options.create') }}" class="btn btn-primary">Ajouter Famille d'Option</a>
                                                <a href="{{ route('admin.options.create', $familleOption->id) }}" class="btn btn-primary">Ajouter Option</a>
                                            </div>
                                            <div class="text-start">
                                                {{ $familleOptions->links('vendor.pagination.bootstrap-5') }}
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
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
    </script>
@endsection
