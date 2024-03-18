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
                                    
                                    <h2 class="text-center">Ajouter Famille Option</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.famille-options.store') }}" method="POST">
                                            @csrf
											 <div class="form-group">
                                                <label for="nom_famille_option">Nom Famille d'Option</label>
                                                <input type="text" name="nom_famille_option" id="nom_famille_option" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type de famille par Option </label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="simple">Obligatoire</option>
                                                    <option value="multiple">Au choix</option>
                                                    <option value="qte">Quantité</option>
                                                </select>
                                            </div>
                                           
											
											 <div class="form-group" style="display: none;" id="nbre_de_choix1">
							 				 
        <label for="nbre_de_choix">Nombre de choix maximum possible</label>
        <input type="number" name="nbre_de_choix" id="nbre_de_choix" class="form-control"  >
   </div>
											 		
 
											


                                             <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Créer</button>
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
        // Listen for changes in the 'Type de famille par Option' dropdown
      $('#type').change(function () {
        var selectedValue = $(this).val();

        // Reset both fields to their default state
        $('#nbre_de_choix').prop('required', false);
       
        if (selectedValue === 'multiple') {
            // If 'multiple' is selected, make 'Nombre de choix' input required
            $('#nbre_de_choix').prop('required', true);
        } 
    });
    });
</script>
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
