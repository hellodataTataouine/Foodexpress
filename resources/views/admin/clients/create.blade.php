@extends('base')

@section('title', 'Welcome')

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
                                    <h2 class="text-center">Nouveau Restaurant</h2>
                                    <div class="table-responsive">
                                        <form method="POST" action="{{ url('admin/clients') }}"
                                        enctype="multipart/form-data">
                                            @csrf
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            <div id="section1" class="section">
                                                <label for="name">Nom:</label>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                                <span id="name-error" style="color: red; display: none;">Merci d'entrer un nom valide</span>

                                                <label for="phoneNum1">Numéro de Teléphone 1:</label>
                                                <input type="text" name="phoneNum1" id="phoneNum1" class="form-control"
                                                       required>
                                                <span id="phoneNum1-error" style="color: red; display: none;">Veuillez saisir un numéro de téléphone valide</span>


                                                <label for="phoneNum2">Numéro de Teléphone 2(Optional):</label>
                                                <input type="text" name="phoneNum2" id="phoneNum2" class="form-control">
                                                <span id="phoneNum2-error" style="color: red; display: none;">Veuillez entrer un numéro de téléphone</span>

                                                <label for="localisation">Adresse:</label>
                                                <input type="text" name="localisation" id="localisation"
                                                       class="form-control" required>
                                                <span id="localisation-error" style="color: red; display: none;">Veuillez entrer une adresse valide</span>

                                                <br/>
                                                <h4 class="card-title">Codes postaux des services</h4>
                                                <p>Ajoutez un ou plusieurs codes postaux :</p>
                                                <div id="postal-codes-container">
                                                    <div class="form-group">
                                                        <input type="text" name="postal_codes[]" id="postal_codes[]"
                                                               class="form-control" placeholder=" Code Postal" required>
                                                        <span id="postal_codes[]-error"
                                                        style="color: red; display: none;">Veuillez entrer un code postal valide</span>

                                                        <br/>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="addPostalCodeField()">+ code postal
                                                        </button>
                                                    </div>
                                                </div>
                                                <label for="localisation">Numero Siret:</label>
                                                <input type="text" name="N_Siret" id="N_Siret"
                                                                class="form-control" placeholder="Numero Siret" required>
                                                            <span id="N_Siret-error"
                                                            style="color: red; display: none;">Veuillez entrer un numéro de siret valide</span>

                                                            <br/>
                                                                <label for="localisation">Numero TVA:</label>
                                                                <input type="text" name="N_Tva" id="N_Tva"
                                                               class="form-control" placeholder="Numero TVA" required>
                                                        <span id="N_Tva-error"
                                                        style="color: red; display: none;">Veuillez entrer un numéro de TVA valide</span>
                                            </div>
                                            <div id="section2" class="section" style="display: none;">

                                                <!-- User Information -->
                                                <h4 class="card-title mt-4">Informations de l'utilisateur</h4>
                                                <label for="username">Nom d'utilisateur:</label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                       required>
                                                <span id="username-error"
                                                      style="color: red; display: none;">required</span>

                                                <label for="email">E-mail:</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                       required>
                                                       <span id="email-error" style="color: red; display: none;">Veuillez entrer un email valide</span>

                                                       <label for="password">Mot de passe:</label>
                                                       <input type="password" name="password" id="password"
                                                       class="form-control" required>
                                                <span id="password-error"
                                                      style="color: red; display: none;">required</span>

                                            </div>

                                            <div id="section3" class="section" style="display: none;">
                                                <h4 class="card-title">Gestion des horaires pour le client :</h4>

                                                <div id="horaires-container">
                                                    <div class="horaire">
                                                        <label for="datedebut">Date de début :</label>
                                                        <input type="date" id="datedebut" name="horaires[0][date_debut]"
                                                               class="form-control" required>
                                                        <span id="datedebut-error" style="color: red; display: none;">required</span>

                                                        <label for="datafin">Date de fin :</label>
                                                        <input type="date" id="datafin" name="horaires[0][date_fin]"
                                                               class="form-control" required>
                                                        <span id="datafin-error" style="color: red; display: none;">required</span>

                                                        <label for="heure_ouverture">Heure d'ouverture :</label>
                                                        <input type="time" id="heure_ouverture"
                                                               name="horaires[0][heure_ouverture]" class="form-control"
                                                               required>
                                                        <span id="heure_ouverture-error"
                                                              style="color: red; display: none;">required</span>

                                                        <label for="heure_fermeture">Heure de fermeture :</label>
                                                        <input type="time" id="heure_fermeture"
                                                               name="horaires[0][heure_fermeture]" class="form-control"
                                                               required>
                                                        <span id="heure_fermeture-error"
                                                              style="color: red; display: none;">required</span>

                                                    </div>
                                                </div>
                                                <br/>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="addHoraireField()">+ horaires
                                                </button>
                                            </div>


                                            <div id="section4" class="section" style="display: none;">
                                                <h4 class="card-title">Service Jours de repos</h4>
                                                <p value="">Ajouter un ou plusieur jour de repos</p>
                                                <div id="joursferiers-container">
                                                    <div class="form-group">
                                                        <select name="joursferiers[]" id="joursferiers[]"
                                                                class="form-control" required>
                                                                <option value="">Ajouter un ou plusieur jour de repos</option>
                                                                <option value="Lundi">Lundi</option>
                                                            <option value="Mardi">Mardi</option>
                                                            <option value="Mercredi">Mercredi</option>
                                                            <option value="Jeudi">Jeudi</option>
                                                            <option value="Vendredi">Vendredi</option>
                                                            <option value="Samedi">Samedi</option>
                                                            <option value="Dimanche">Dimanche</option>
                                                            <option value="Aucun">Aucun</option>
                                                        </select>
                                                        <span id="joursferiers[]-error"
                                                              style="color: red; display: none;">requis</span>

                                                        <br/>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="addJourFerieField()">+ jour de repos
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="section5" class="section" style="display: none;">
                                                <h4 class="card-title">Service Logo</h4>
                                                <p>Logo Image:</p>
                                                <div id="logo-container">
                                                    <div class="form-group">
                                                        <input type="file" name="url_image" class="form-control"
                                                               id="imageInput">
                                                        <div class="image-preview"></div>
                                                    </div>


                                                </div>
                                            </div>


                                    </div>
                                </div>


                                <br/>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="button" class="btn btn-outline-primary btn-lg mr-2" onclick="previousSection()" style="display: none;" id="previousbutton">
                                        Précédent
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-lg" onclick="nextSection()" id="nextbutton">Suivant</button>
                                </div>
                                

                                <button type="submit" class="btn btn-outline-success" style="display: none;">Enregistrer </button>
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


        // script for logo upload
        $(document).ready(function () {
            // Listen for changes in the file input
            $('#imageInput').on('change', function (e) {
                var files = e.target.files;
                var imagePreview = $('.image-preview');
                imagePreview.empty();

                // Loop through the selected files and create an image preview for each
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var image = $('<img style="width:700px;height:400px;">').attr('src', e.target.result).addClass('img-fluid');
                        imagePreview.append(image);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });


        //
        document.addEventListener('DOMContentLoaded', function () {
            var sections = document.querySelectorAll('.section');
            var form = document.querySelector('form');
            var submitButton = document.querySelector('button[type="submit"]');
            var currentSection = 0;
          //  disableNextButton(); // Disable the next button initially

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                if (currentSection === sections.length - 1) {
                    form.submit();
                } else {
                    nextSection();
                }
            });

            function showSection(index) {
    for (var i = 0; i < sections.length; i++) {
        if (i === index) {
            sections[i].style.display = 'block';
        } else {
            sections[i].style.display = 'none';
        }
    }
    
    if (index === sections.length - 1) {
        submitButton.style.display = 'block';
        var nextbutton = document.getElementById('nextbutton');
        nextbutton.style.display = 'none';
    } else {
        submitButton.style.display = 'none';
        var nextbutton = document.getElementById('nextbutton');
        nextbutton.style.display = 'block';
    }
    
  
}


            function navigateToSection(index) {
                if (index >= 0 && index < sections.length) {
                    showSection(index);
                    currentSection = index;
                }
            }

            function nextSection() {
                var isValid = validateSection();
        if (isValid) {
            navigateToSection(currentSection + 1);
        } else {
            // Show error message or take appropriate action
            alert('Veuillez vous assurer que le champs sont uniques avant de continuer.');
        }            }

            function previousSection() {
                navigateToSection(currentSection - 1);
            }

            navigateToSection(currentSection);
        });    


        function validateSection() {
            var currentSection = document.querySelector('.section:not([style*="display: none"])');
            var inputFields = currentSection.querySelectorAll('input, select');
            var isValid = true;

            for (var i = 0; i < inputFields.length; i++) {
                var inputField = inputFields[i];
                var errorMessage = document.getElementById(inputField.id + '-error');

                if (!inputField.checkValidity()) {
                    errorMessage.style.display = 'block'; // Display error message
                    // inputField.classList.add('invalid'); // Add CSS class for invalid input

                    isValid = false; // Validation failed
                } else {
                    errorMessage.style.display = 'none'; // Hide error message
                    //  inputField.classList.remove('invalid'); // Remove CSS class for valid input
                }
            }

            return isValid;
        }


        function nextSection() {
    if (validateSection()) {
        var currentSection = document.querySelector('.section:not([style*="display: none"])');
        var nextSection = currentSection.nextElementSibling;

        if (currentSection.id === 'section1') {
           // disableNextButton();

            var name = document.getElementById('name').value;
            var phoneNum1 = document.getElementById('phoneNum1').value;
            var phoneNum2 = document.getElementById('phoneNum2').value;

            $.ajax({
                url: '/admin/client/check-uniqueness',
                method: 'POST',
                data: {
                    name: name,
                    phoneNum1: phoneNum1,
                    phoneNum2: phoneNum2,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response); // Check the entire response object in the console

if (response.status === 'unique') {
    showNextSection();
} else if (response.status === 'not-unique') {
    alert('Veuillez vous assurer que le champs est unique avant de continuer.');
    enableNextButton(); // Enable the next button
}
                },
                error: function () {
                    alert('Une erreur s est produite. Veuillez réessayer.');
                }
            });
        } else if (currentSection.id === 'section2') {
    // disableNextButton();

    var email = document.getElementById('email').value;
    var username = document.getElementById('username').value;

    $.ajax({
        url: '/admin/user/check-uniqueness', 
        method: 'POST',
        data: {
            email: email,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            console.log(response); // Check the entire response object in the console

            if (response.status === 'unique') {
                showNextSection();
            } else if (response.status === 'not-unique') {
                alert('Veuillez vous assurer que le champs est unique avant de continuer.');
                enableNextButton(); // Enable the next button
            }
        },
        error: function () {
            alert('Une erreur s est produite. Veuillez réessayer.');
        }
    });
}

        else {
            showNextSection();
        }
    }
}

function showNextSection() {
    var currentSection = document.querySelector('.section:not([style*="display: none"])');
    var nextSection = currentSection.nextElementSibling;

    currentSection.style.display = 'none';
    nextSection.style.display = 'block';
    var previousButton = document.getElementById('previousbutton');
    previousButton.style.display = 'block';

    if (nextSection.id === 'section5') {
        var nextButton = document.getElementById('nextbutton');
        nextButton.style.display = 'none';
        document.querySelector('button[type="submit"]').style.display = 'block';
    } else {
        document.querySelector('button[type="submit"]').style.display = 'none';
    }
}

function disableNextButton() {
    var nextButton = document.getElementById('nextbutton');
    nextButton.disabled = true;
}

function enableNextButton() {
    var nextButton = document.getElementById('nextbutton');
    nextButton.disabled = false;
}






        function previousSection() {
            var currentSection = document.querySelector('.section:not([style*="display: none"])');
            var previousSection = currentSection.previousElementSibling;
            currentSection.style.display = 'none';
            previousSection.style.display = 'block';
            var nextbutton = document.getElementById('nextbutton');
            nextbutton.style.display = 'block'
              
           if (previousSection.id === 'section4') {
               
                document.querySelector('button[type="submit"]').style.display = 'block';
            } else {

                document.querySelector('button[type="submit"]').style.display = 'none';
            }
            if (previousSection.id === 'section1') {

                var previousbutton = document.getElementById('previousbutton');
                previousbutton.style.display = 'none'
                  
                
            }
           

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

    var spanError = document.createElement('span');
    spanError.id = 'postal_codes[]-error';
    spanError.style.color = 'red';
    spanError.style.display = 'none';
    spanError.textContent = 'Veuillez entrer un code postal valide';

    var lineBreak = document.createElement('br');
    
    // Remove the existing "Delete" button if it exists
    var deleteButton = container.querySelector('.delete-button');
    if (deleteButton) {
        container.removeChild(deleteButton);
    }

   /*    var addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.className = 'btn btn-primary';
    addButton.textContent = '+ code postal';
    addButton.onclick = addPostalCodeField;  */

    var div = document.createElement('div');
    div.className = 'form-group';
    div.appendChild(input);
    div.appendChild(spanError);
    div.appendChild(lineBreak);
  //  div.appendChild(addButton);

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
    console.log(remainingInputs.length);
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
    deleteButton.textContent = 'supprimer dernier';
    deleteButton.onclick = deleteLastPostalCodeField;

    return deleteButton;
}



        function addHoraireField() {
            var container = document.getElementById('horaires-container');

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
            removeButton.innerText = 'Remove';
            removeButton.onclick = function () {
                if (container.getElementsByClassName('horaire').length > 1) {
                    container.removeChild(outlinedWrapper);
                } else {
                    alert('Au moins un horaire doit être présent.');
                }
            };
//horaire.appendChild(hr);
            // horaire.appendChild(br);
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
        }


        function addJourFerieField() {
            var container = document.getElementById('joursferiers-container');

            var fieldGroup = document.createElement('div');
            fieldGroup.className = 'form-group';

            var selectJourFerier = document.createElement('select');
            selectJourFerier.name = 'joursferiers[]';
            selectJourFerier.id = 'joursferiers[]';
            selectJourFerier.className = 'form-control';
            selectJourFerier.required = true;

            var optionDefault = document.createElement('option');
            optionDefault.value = '';
            optionDefault.disabled = true;
            optionDefault.selected = true;
            optionDefault.textContent = 'Select jour ferier';

            // Add options for different jours feriers
            var jourFeriers = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche', 'Aucun']; // Replace with your list of jours feriers
            jourFeriers.forEach(function (jourFerier) {
                var option = document.createElement('option');
                option.value = jourFerier; // Set the jour ferier name as the value
                option.textContent = jourFerier;
                selectJourFerier.appendChild(option);
            });

         /*   var addButton = document.createElement('button');
            addButton.type = 'button';
            addButton.className = 'btn btn-primary';
            addButton.textContent = 'Add';
            addButton.onclick = addJourFerieField;*/

            fieldGroup.appendChild(selectJourFerier);
            fieldGroup.appendChild(document.createElement('br'));
          //  fieldGroup.appendChild(addButton);

            container.appendChild(fieldGroup);
        }


    </script>
@endsection


