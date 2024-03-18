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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">Modifier Famille Option</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.famille-options.update', $familleOptionRestaurant->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                
                                            <div class="mb-3">
                                                <label for="nom_famille_option" class="form-label">Nom Famille Option</label>
                                                <input type="text" class="form-control" id="nom_famille_option" name="nom_famille_option" value="{{ $familleOptionRestaurant->nom_famille_option }}" required>
                                            </div>
                
                                            <div class="mb-3">
                                                <label for="type">Type</label>
                                                <select name="type" id="type" class="form-control"  required >
                                                    <option value="simple" {{ $familleOptionRestaurant->type == "simple" ? 'selected' : '' }}>Obligatoire</option>
                                                    <option value="multiple" {{ $familleOptionRestaurant->type == "multiple" ? 'selected' : '' }}>Au choix</option>
                                                    <option value="qte" {{ $familleOptionRestaurant->type == "qte" ? 'selected' : '' }}>Quantité</option>
                                                </select> </div>
						@if($familleOptionRestaurant->type == "multiple")			
                <div class="form-group"  id="nbre_de_choix1">
							 				 
        <label for="nbre_de_choix">Nombre de choix maximum possible</label>
        <input type="number" name="nbre_de_choix" id="nbre_de_choix" class="form-control" value={{ $familleOptionRestaurant->nbre_choix }} >
   </div>
				@endif							 
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                <a href="{{ route('restaurant.famille-options.index') }}" class="btn btn-secondary">Annuler</a>
                                            </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#type').change(function () {
            // Show/hide the "Nombre de choix" input based on the selected value
            if ($(this).val() === 'multiple') {
                $('#nbre_de_choix1').show();
				
            } 
			 else {
               
				 $('#nbre_de_choix1').hide();
            }
        });
		
    });
</script>
