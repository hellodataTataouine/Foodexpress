@extends('base')

@section('title', 'Meta-data')

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
                    <h4 class="card-title" style="color: black;">Zones de service</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                    <div class="table-responsive">
                   <form method="POST" action="#" enctype="multipart/form-data">
                          @csrf
              
                         
                        <div class="mb-3">
                            <label for="postalcode" class="form-label">Code postale</label>
                            <input class="form-control" type="number" placeholder="Example 75000"  min="0" max="100000" id="postalcode"/>
                        </div>
                        <div class="mb-3">
                            <label for="mincmd" class="form-label">Montant minimal requis pour une commande</label>
                            <input class="form-control" type="number" placeholder="Example 50.0"  min="0" max="100000" id="mincmd"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                      </form>
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