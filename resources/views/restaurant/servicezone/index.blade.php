@extends('base')

@section('title', 'Zone de service')

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

           
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">List Zone de service</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                          
                      {{-- <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div> --}}
                      <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                               
                                    
                                    <th>Code Postal</th>
                                    <th>Mantant minimal requis</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicezone as $cp)
                                    <tr>
                                   
                                      
                                        <td>{{ $cp->postal_code}}</td>
                                        <td>{{ $cp->min_cmd }}</td>
                                     
                                        
                                        <td style="display: flex; justify-content: space-between;">
                                         
                                          
                                            <a href="{{ route('restaurant.servicezone.edit', $cp->id) }}" class="btn btn-warning btn-sm col-s">Modifier</a>
											
                                            <form action="{{ route('restaurant.servicezone.destroy', $cp->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Voulez-vous vraiment supprimer cette zone de service?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="{{ route('restaurant.servicezone.create') }}" class="btn btn-primary mb-3">Ajouter une zone de service</a>
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