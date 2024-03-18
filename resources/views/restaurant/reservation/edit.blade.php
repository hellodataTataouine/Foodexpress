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

            
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Modifier Reservation</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('restaurant.resevation.update', $reservation) }}"  enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                
                           
                            <div class="form-group">
                            <label for="type_methode">N° Personnes</label>
                                <input type="number" class="form-control" id="nbre_personnes" value="{{$reservation->nbre_Personnes }}" name="nbre_personnes" required>
                                @error('nbre_personnes')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="form-group">
                                <label for="type_methode">Heure Début</label>
                                    <input type="time" class="form-control" id="heure_debut" name="heure_debut" value="{{$reservation->heure_debut }}" required>
                                    @error('heure_debut')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                                <div class="form-group">
                                    <label for="type_methode">Heure Fin</label>
                                        <input type="time" class="form-control" id="heure_fin" name="heure_fin" value="{{$reservation->heure_fin }}"  required>
                                        @error('heure_fin')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="type_methode">Date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="{{$reservation->date }}" required>
                                            @error('date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="table_id">Table:</label>
                                            <select name="table_id" class="form-control" required id="table_id">
                                                @foreach ($tables as $table)
                                                <option  {{ $reservation->table_id == $table->id ? 'selected' : '' }}>
                                                    {{$table->designation}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="client_id">Client:</label>
                                            <select name="client_id" class="form-control" required>
                                                @foreach ($clients as $client)
                                                <option value="{{ $client->id }}" {{ $reservation->client_id == $client->id ? 'selected' : '' }}>
                                                    {{ $client->FirstName }} {{ $client->LastName }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
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
         // Your JavaScript code that uses jQuery
         $(document).ready(function() {
             // Function to fetch available tables based on criteria
             function fetchAvailableTables() {
                 var nbrePersonnes = $('#nbre_personnes').val();
                 var heureDebut = $('#heure_debut').val();
                 var heureFin = $('#heure_fin').val();
                 var date = $('#date').val();
				 // Check if heure_fin is greater than heure_debut
        if (heureFin <= heureDebut) {
            alert('L\'heure de fin doit être supérieure à l\'heure de début');
            return;
        }
     
                 $.ajax({
                     url: "{{ route('restaurant.fetch.available.tables') }}",
                     type: "GET",
                     data: {
    _token: '{{ csrf_token() }}',
    nbre_personnes: nbrePersonnes,
    heure_debut: heureDebut,
    heure_fin: heureFin,
    date: date
},
                     success: function(response) {
                         // Clear the current dropdown options
                         $('#table_id').empty();
     
                         // Add available table options to the dropdown
                         $.each(response, function(index, table) {
                             $('#table_id').append('<option value="' + table.id + '">' + table.designation + '</option>');
                         });
						 // Check if the currently selected table is in the list of available tables
                var selectedTableId = $('#table_id').val();
                if (!response.some(table => table.id == selectedTableId)) {
                    alert('La table sélectionnée n\'est pas disponible pour les critères spécifiés.');
                    // You might want to reset the selected table or take other actions.
                }
                     },
                     error: function(xhr, status, error) {
                         console.error(xhr.responseText);
                     }
                 });
             }
     
             // Trigger the fetchAvailableTables function when the criteria fields change
             $(document).on('change', '#nbre_personnes, #heure_debut, #heure_fin, #date', function() {
                 fetchAvailableTables();
             });
         });
     </script>