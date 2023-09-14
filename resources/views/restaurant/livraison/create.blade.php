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
                      <h4 class="card-title">Ajouter Livraison Methode</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('restaurant.livraison.store') }}">
                            @csrf
                
                            <div class="form-group">
                                <label for="methode_livraison">Méthode de livraison</label>
                                <select id="methode_livraison" name="methode_livraison" class="form-control" rquired>
                                  @foreach ($livraisonMethods  as $livraison )
                                  <option value="{{$livraison->id}}">{{$livraison->methode}}</option>
                                      
                                  @endforeach
                                </select>

                                
                            </div>
                
                            <button type="submit" class="btn btn-primary">Ajouter</button>
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
