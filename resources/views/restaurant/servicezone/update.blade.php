
@extends('base')

@section('title', 'Zone de service |Modifier')

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
                      <h4 class="card-title" style="color: black;">Modifier Zone de service</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <form action="{{ route('restaurant.servicezone.update', $postalcode->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                        <div class="mb-3">
                            <label for="postalcode" class="form-label">Code postale</label>
                            <input class="form-control" type="number" placeholder="Example 75000"  min="0" max="100000" id="postalcode" name="postal_code" value="{{ $postalcode->postal_code }}" required/>
                        </div>
                        <div class="mb-3">
                            <label for="mincmd" class="form-label">Montant minimal requis pour une commande</label>
                            <input class="form-control" type="number" placeholder="Example 50.0" step="0.01" min="0" max="100000" id="mincmd" name="mincmd" value="{{ $postalcode->min_cmd }}" required/>
                        </div>
                        <button class="btn btn-primary" type="submit">Modifier</button>
                      </form>
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