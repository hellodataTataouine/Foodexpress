@extends('base')

@section('title', 'Edit Restaurant')

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
                                    <h2 class="text-center">Modifier Restaurant</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @elseif ($errors->first('name'))
                                        <div class="alert alert-danger">
                                            {{  $errors->first('name')  }}
                                        </div>
                                    @endif


                                    <div class="table-responsive">
                                        <form method="POST" action="{{ route('admin.clients.update', ['id' => $client->id]) }}"  enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <label for="name">Nom:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}">
                                        
                                            <label for="phoneNum1">Numéro Télephone 1:</label>
                                            <input type="text" name="phoneNum1" id="phoneNum1" class="form-control" value="{{ $client->phoneNum1 }}">
                                            <label for="phoneNum2">Numéro Télephone 2:</label>
                                            <input type="text" name="phoneNum2" id="phoneNum2" class="form-control" value="{{ $client->phoneNum2 }}">
                                        
                                            <label for="localisation">Adresse:</label>
                                            <input type="text" name="localisation" id="localisation" class="form-control" value="{{ $client->localisation }}">
                                            
                                         
                                            <br>
                                              <!-- Codes Postal -->
                                              <div id="postal-codes-container" class="card-title mt-4">

                                           <h4 class="card-title mt-4">Zone de service </h4>
        @if ($client->postalCodes)
            @foreach ($client->postalCodes as $index => $postalCode)
                <div class="form-group">
                    <input type="text" name="postal_codes[]" class="form-control" value="{{ $postalCode->postal_code }}">
                    @if ($index > 0)
                        <button type="button" class="btn btn-danger" onclick="deletePostalCodeField(this)">-</button>
                    @endif
                </div>
            @endforeach
        @endif
        </div>
                                        <button type="button" class="btn btn-primary" onclick="addPostalCodeField()">+ code postal</button>
                                                        
  <!-- Codes SIRET-->
  <div class="card-title mt-4">
        <h6 class="card-title mt-4">Code Siret </h6>

        <div class="form-group">
        <input type="text" name="N_Siret" class="form-control" value="{{ $client->N_Siret }}">
       </div>
        </div>
        
        <!-- Codes TVA -->
        <div  class="card-title mt-4">

        <h6 class="card-title mt-4">Code TVA  </h6>

        <div class="form-group">
        <input type="text" name="N_Tva" class="form-control" value="{{ $client->N_Tva }}">
 
        </div>

        </div>    
                                        <!-- Horaires -->
                                        <div id="horaires-container">
                                       
                                            
                                        <h4 class="card-title mt-4">Gestion des horaires :</h4>
                                        @if ($client->horaires)
                                       
                                        @foreach ($client->horaires as $index => $horaire)
                                        
                                                    <div class="horaire">
                                                        <label for="datedebut">Date de début :</label>
                                                        <input type="date" id="datedebut" name="horaires[0][date_debut]"
                                                               class="form-control"  value="{{ $horaire->date_debut }}">
                                                      
                                                        <label for="datafin">Date de fin :</label>
                                                        <input type="date" id="datafin" name="horaires[0][date_fin]"
                                                               class="form-control" value="{{ $horaire->date_fin }}">
                                                      
                                                        <label for="heure_ouverture">Heure d'ouverture :</label>
                                                        <input type="time" id="heure_ouverture"
                                                               name="horaires[0][heure_ouverture]" class="form-control"
                                                               value="{{ $horaire->heure_ouverture }}">
                                                       
                                                        <label for="heure_fermeture">Heure de fermeture :</label>
                                                        <input type="time" id="heure_fermeture"
                                                               name="horaires[0][heure_fermeture]" class="form-control"
                                                               value="{{ $horaire->heure_fermeture }}">
                                                               @if ($index > 0)
                        <button type="button" class="btn btn-danger" onclick="deletehorairesField(this)">-</button>
                    @endif
                                                    </div>
                                                

                                                @endforeach
                                        @endif
                                        </div>
                                        <button type="button" class="btn btn-primary" onclick="addHoraireField()">+ Horaire</button>
                                        
                                       
                                       
                                        <!-- Jour ferier -->
                                         <div class="joursferiers-container">
   
                                        <h4 class="card-title mt-4">Gestion des jours de repos :</h4>
                                        @if ($client->jourFeriers)
                                      
                                        @foreach ($client->jourFeriers as  $index => $jourFerier)
                                            <div class="form-group">
                                            <select name="joursferiers[]" id="joursferiers[]" class="form-control" required>
                <option value="">Ajouter un ou plusieur jour de repos</option>
                <option value="Lundi" {{ $jourFerier->jour === 'Lundi' ? 'selected' : '' }}>Lundi</option>
                <option value="Mardi" {{ $jourFerier->jour === 'Mardi' ? 'selected' : '' }}>Mardi</option>
                <option value="Mercredi" {{ $jourFerier->jour === 'Mercredi' ? 'selected' : '' }}>Mercredi</option>
                <option value="Jeudi" {{ $jourFerier->jour === 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                <option value="Vendredi" {{ $jourFerier->jour === 'Vendredi' ? 'selected' : '' }}>Vendredi</option>
                <option value="Samedi" {{ $jourFerier->jour === 'Samedi' ? 'selected' : '' }}>Samedi</option>
                <option value="Dimanche" {{ $jourFerier->jour === 'Dimanche' ? 'selected' : '' }}>Dimanche</option>
                <option value="Aucun" {{ $jourFerier->jour === 'Aucun' ? 'selected' : '' }}>Aucun</option>
            </select>
                                                    
            @if ($index > 0)
                        <button type="button" class="btn btn-danger" onclick="deletejourferierField(this)">-</button>
                    @endif
                                            </div>
                                        @endforeach
                                       
                                        @endif
                                        <button type="button" class="btn btn-primary" onclick="addJourFerierField()">+ Jour Ferié</button>
                                        </div>
                                      
                                        <!-- Logo -->

                                        <h4 class="card-title mt-4">Logo:</h4>
                                        @if ($client->logo)
                                        <div class="form-group">
                                        <img  id="clientLogo" src="{{ asset($client->logo) }}" alt="Logo" width="100" height="100">
                                            </div>
                                        @endif
                                        <div class="form-group">
                                        <label for="image">Image:</label>
                                            
                                                <input type="file" id="image" name="image" accept="image/*" class="form-control">
                                            </div>
                                       
                                        <br>

                                            <button type="submit" class="btn btn-primary" name="submit">Mettre à jour le restaurant</button>
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

<script>
   
 $(document).ready(function () {
            // Listen for changes in the file input
            $('input[name="image"]').change(function () {
                // Get the selected file
                var file = $(this).prop('files')[0];

                // Create a URL object from the file
                var imageURL = URL.createObjectURL(file);

                // Update the image source with the new URL
                $('#clientLogo').attr('src', imageURL);
            });
        });

 
        </script>
<script>
// Delete postal code field
function deletePostalCodeField(button) {
        button.parentNode.remove();
    }

    function deletehorairesField(button) {
        button.parentNode.remove();
    }

    function deletejourferierField(button) {
        button.parentNode.remove();
    }

   function addPostalCodeField() {
    var container = document.getElementById('postal-codes-container');
    var inputs = container.getElementsByTagName('input');

    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'postal_codes[]';
    input.id = 'postal_codes[]';
    input.className = 'form-control';
    input.placeholder = 'Code Postal';
    input.required = true;

    var lineBreak = document.createElement('br');

    // Remove the existing "Delete" button if it exists
    var deleteButton = container.querySelector('.delete-button');
    if (deleteButton) {
        container.removeChild(deleteButton);
    }

    var div = document.createElement('div');
    div.className = 'form-group';
    div.appendChild(input);
   // div.appendChild(lineBreak);

    container.appendChild(div);
    container.appendChild(createDeleteButton());
}

function deleteLastPostalCodeField() {
    var container = document.getElementById('postal-codes-container');
    var divs = container.getElementsByClassName('form-group');

    if (divs.length > 1) {
        container.removeChild(divs[divs.length - 1]);
    }

    // Check the number of remaining inputs
    var remainingInputs = container.getElementsByClassName('form-group');
    var deleteButton = document.getElementById('delete-button');
    if (remainingInputs.length <= 1) {
        deleteButton.style.display = 'none';
    } else {
        deleteButton.style.display = 'block';
    }
}

function createDeleteButton() {
    var deleteButton = document.createElement('button');
    deleteButton.id = 'delete-button';
    deleteButton.type = 'button';
    deleteButton.className = 'btn btn-danger delete-button';
    deleteButton.textContent = '-';
    deleteButton.onclick = deleteLastPostalCodeField;

    return deleteButton;
}

function addHoraireField() {
    var container = document.getElementById('horaires-container');
    if (container) {
        var horaire = document.createElement('div');
        horaire.className = 'horaire';

        var index = container.getElementsByClassName('horaire').length;

        var labelDebut = document.createElement('label');
        labelDebut.innerText = 'Date de début:';
        var inputDebut = document.createElement('input');
        inputDebut.type = 'date';
        inputDebut.name = 'horaires[' + index + '][date_debut]';
        inputDebut.className = 'form-control';
        inputDebut.required = true;

        var labelFin = document.createElement('label');
        labelFin.innerText = 'Date de fin:';
        var inputFin = document.createElement('input');
        inputFin.type = 'date';
        inputFin.name = 'horaires[' + index + '][date_fin]';
        inputFin.className = 'form-control';
        inputFin.required = true;

        var labelOuverture = document.createElement('label');
        labelOuverture.innerText = 'Heure d\'ouverture:';
        var inputOuverture = document.createElement('input');
        inputOuverture.type = 'time';
        inputOuverture.name = 'horaires[' + index + '][heure_ouverture]';
        inputOuverture.className = 'form-control';
        inputOuverture.required = true;

        var labelFermeture = document.createElement('label');
        labelFermeture.innerText = 'Heure de fermeture:';
        var inputFermeture = document.createElement('input');
        inputFermeture.type = 'time';
        inputFermeture.name = 'horaires[' + index + '][heure_fermeture]';
        inputFermeture.className = 'form-control';
        inputFermeture.required = true;

        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger';
        removeButton.innerText = '-';
        removeButton.onclick = function () {
            if (container.getElementsByClassName('horaire').length > 1) {
                container.removeChild(outlinedWrapper);
            } else {
                alert('At least one horaire should be present.');
            }
        };

        horaire.appendChild(labelDebut);
        horaire.appendChild(inputDebut);
        horaire.appendChild(labelFin);
        horaire.appendChild(inputFin);
        horaire.appendChild(labelOuverture);
        horaire.appendChild(inputOuverture);
        horaire.appendChild(labelFermeture);
        horaire.appendChild(inputFermeture);

        // Create the outlined section
        var section = document.createElement('div');
        section.className = 'section outlined';
        section.appendChild(horaire);
        section.appendChild(removeButton);

        // Append the outlined section to a wrapping div
        var outlinedWrapper = document.createElement('div');
        outlinedWrapper.appendChild(section);
        outlinedWrapper.appendChild(document.createElement('br'));

        container.appendChild(outlinedWrapper);
    } else {
        console.error("Erreur : Impossible de trouver l'élément 'horaires-container'.");
    }
}


    function addJourFerierField() {
  var container = document.querySelector('.joursferiers-container');

  if (!container) {
    console.error('Container element not found.');
    return;
  }

  var fieldGroup = document.createElement('div');
  fieldGroup.className = 'form-group';

  var selectJourFerier = document.createElement('select');
  selectJourFerier.name = 'joursferiers[]';
  selectJourFerier.className = 'form-control';
  selectJourFerier.required = true;

  var optionDefault = document.createElement('option');
  optionDefault.value = '';
  optionDefault.disabled = true;
  optionDefault.selected = true;
  optionDefault.textContent = 'Select jour férié';

  // Add options for different jours fériés
  var jourFeriers = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche', 'Aucun'];
  jourFeriers.forEach(function (jourFerier) {
    var option = document.createElement('option');
    option.value = jourFerier;
    option.textContent = jourFerier;
    selectJourFerier.appendChild(option);
  });

  var removeButton = document.createElement('button');
  removeButton.type = 'button';
  removeButton.className = 'btn btn-danger';
  removeButton.textContent = '-';
  removeButton.addEventListener('click', function () {
    container.removeChild(fieldGroup);
  });

  fieldGroup.appendChild(selectJourFerier);
  fieldGroup.appendChild(removeButton);

  container.appendChild(fieldGroup);
}


    // Retrieve the existing horaires and add the necessary fields
    var horaires = {!! $client->horaires !!}; // Assuming you pass the horaires to the view as a variable

    //if (horaires.length > 0) {
       // horaires.forEach(function (horaire) {
         //   addHoraireField(horaire);
       // });
 //   }
</script>
@endsection
