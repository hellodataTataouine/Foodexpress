
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
                      <h4 class="card-title">Clients</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                 
    <table id="myTable" class="table" style="width: 100%">
                                             <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Country</th>
                <th>Address</th>
                <th>Postal Code</th>
                <th>Phone Number </th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->FirstName }}</td>
                    <td>{{ $client->LastName }}</td>
                    <td>{{ $client->ville }}</td>
                    <td>{{ $client->Address }}</td>
                    <td>{{ $client->codepostal }}</td>
                    <td>{{ $client->phoneNum1 }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <!--<a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">View</a>-->
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-between">
                                          <div class="text-end">
                                            <a href="{{ route('restaurant.clients.create') }}" class="btn btn-primary">Ajouter Client</a>
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

      
     @endsection