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
                                                <label for="nom_famille_option" class="form-label">Nom</label>
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
                
          								
											<div class="table-responsive">
                                   <h6 class="mb-4">options</h6> 
                                    <table class="table table-bordered text-center" id="childProductsTable" style="border-radius: 10px; overflow: hidden;">
                                       
                                            <thead>
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Désignation</th>
													  <th>Disponible</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($options->sortBy('RowN') as $option)
                                               
                                                <tr data-option-id="{{ $option->id }}">
                                                    <td>
                                          <i class="fa-solid fa-arrow-up" onclick="moveRowUp(this)" data-disabled="true"></i>
                                        {{$option->RowN}}
                                          <i class="fa-solid fa-arrow-down" onclick="moveRowDown(this)" data-disabled="true"></i>
											</td>	
                                                    <td>
                                                       
                                                       

                                                       {{ $option->nom_option }} <br>
                                                    
                                                       
                                                    </td>
													 <td> 
        <button type="button" class="select-btn btn {{ $option->status ? 'btn-success' : 'btn-danger' }}" 
                data-option="{{ $option->id }}" 
                data-selected="{{ $option->status ? 'Actif' : 'Non Actif' }}">
            {{ $option->status ? 'Actif' : 'Non Actif' }}
        </button>
   
    </td>   
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
											

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
	$(function () {
        $('.select-btn').click(function () {
            var button = $(this);
            var status = button.data('Actif') === 'Actif' ? 0 : 1; // Toggle the status

            var option_id = button.data('option');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/status_option/update',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'option_id': option_id
                },
                success: function (data) {
                    if (status == 1) {
                        button.removeClass('btn-danger').addClass('btn-success').text('Actif');
                        button.data('Actif', 'Actif');
                    } else {
                        button.removeClass('btn-success').addClass('btn-danger').text('Non Actif');
                        button.data('Actif', 'Non Actif');
                    }
                    console.log(data.success);
                }
            });
        });
    }); 
	
	
	
	function moveRowUp(row) {
    var currentRow = row.parentNode.parentNode;
    if (currentRow.rowIndex === 1) {
        return;
    }
    var previousRow = currentRow.previousElementSibling;
    swapRows(currentRow, previousRow);
    updateRowPositions();
}

function moveRowDown(row) {
    var currentRow = row.parentNode.parentNode;
    var nextRow = currentRow.nextElementSibling;
    if (nextRow === null) {
        return;
    }
    swapRows(currentRow, nextRow);
    updateRowPositions();
}

function swapRows(row1, row2) {
    var parent = row1.parentNode;
    var clone1 = row1.cloneNode(true);
    var clone2 = row2.cloneNode(true);
    parent.replaceChild(clone1, row2);
    parent.replaceChild(clone2, row1);
}

function updateRowPositions() {
    var rows = document.querySelectorAll('tbody tr');
    rows.forEach(function(row, index) {
        //var categoryName = row.querySelector('.category-name').textContent;
        var optionId = row.getAttribute('data-option-id');
        var rowN = index + 1;
        // Send an AJAX request to update the RowN property in your database
        updateCategoryRowN(optionId, rowN);
    });
    location.reload();
}

function updateCategoryRowN(optionId, rowN) {
  
    $.ajax({
        url: '/update-option-row-n',
        method: 'POST',
        data: { optionId: optionId, rowN: rowN,  _token: "{{ csrf_token() }}", },
        success: function(data) {
            if (data.success) {
              
                // Success: Show a success message or perform any other action
                console.log('RowN updated successfully.');
            } else {
                // Handle other success scenarios or messages
                console.log('Update was successful but with a different message: ' + data.message);
            }
        },
        error: function(err) {
            // Error: Handle the error response and show an error message
            console.error('An error occurred while updating RowN:', err);
            alert('Error: Unable to update RowN. Please try again.');
        }
    });
}

	
	
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
