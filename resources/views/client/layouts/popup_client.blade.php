<style>
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
    }

    .popup-content {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        z-index: 10000;
        display: none;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        max-width: 1000px;
        width: 95%;
    }

    .popup-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .popup-header h2 {
        font-size: 32px;
        margin: 0;
    }

    .popup-body {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .popup-close {
        background-color: #f44336;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

    .popup-form {
        flex: 1;
        margin-right: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .popup-form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .popup-form p {
        margin-bottom: 10px;
        font-weight: bold;
    }

    .button-container {
    display: flex;
    justify-content: flex-end; 
    align-items: center; 
    margin-top: 10px; 
}

.popup-form button {
    background-color: #477CC7;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px; 
}

.current-location-button {
    color: #477CC7;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.3s ease;
}

.current-location-button:hover {
    color: #3366AA;
}


    .map-container {
        flex: 1;
    }

    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
    }
 
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


@if(!session('showPopup'))
  <!-- Popup Start -->
<div class="popup-overlay"></div>

<div class="popup-content">
    <div class="popup-header">
        <h2>Bienvenue</h2>
        <p>Veuillez entrer votre code postal</p>
    </div>

    <div class="popup-body">
        <!-- Postal code input and Google Map -->
        <div class="popup-form">
    <form method="POST" action="{{ route('validate.postal.code', ['subdomain' => $subdomain]) }}">
        @csrf
        <input type="text" name="postal_code" placeholder="Entrez votre code postal">
    <button type="submit">Valider</button>
    <a href="javascript:void(0);" class="current-location-button">Utiliser lieu actuel</a>



        @if (session('codeError'))

        <p class="error-message">{{ session('codeError') }}</p>
        @elseif (session('showPopup') === false)
        @php
        $phoneNum1 = session('phoneNum1');
        $email = session('email'); // Get the email address from the session
        @endphp
            <p class="error-message" 
            style="color: #ff6347; 
            text-align: center; 
            font-size: 14px; 
            margin: 10px 0; 
            padding: 10px; 
            background-color: #f5f5f5; 
            border: 1px solid #e0e0e0; 
            border-radius: 5px;">
"Nous sommes désolés, mais l'adresse que vous avez fournie se trouve en dehors de notre zone de service. Pour toute question ou pour passer une commande ."            </p>
            <p class="error-message" style="color: #333; font-size: 14px; margin: 10px 0;">
                Veuillez contacter le restaurant au numéro suivant : {{ $phoneNum1 }}
            </p>
            @if (!empty($email))
                <p class="email-message" style="color: #333; font-size: 14px; margin: 10px 0;">
                   Ou à l'adresse e-mail : <b>{{ $email }}</b>
                </p>

        @endif
        @endif

                
        </form>

            <!-- <div class="social-icons">
        <p style="margin-bottom: 20px; font-weight: bold;">Se connecter avec :</p>
        <a href="#" class="facebook-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="google-icon"><i class="fab fa-google"></i></a>
    </div> -->
        </div>
        <div class="map-container">
    <div id="leaflet-map" style="width: 100%; height: 400px;"></div>
</div>
    </div>

</div>
<!-- Popup End -->

@endif
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the map container element
        const mapContainer = document.getElementById("leaflet-map");

        const map = L.map(mapContainer).setView([48.8566, 2.3522], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(map);

        function addCurrentLocationMarker() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    L.marker([latitude, longitude]).addTo(map)
                        .bindPopup('Emplacement actuel')
                        .openPopup();

                    map.setView([latitude, longitude], 16); 

                    fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            const postalCode = data.address.postcode;
                            const postalCodeInput = document.querySelector("input[name='postal_code']");
                            postalCodeInput.value = postalCode;
                        })
                        .catch(error => {
                            console.error("Error fetching postal code:", error);
                            alert("Error fetching postal code.");
                        });
                });
            } else {
                alert("La géolocalisation n'est pas prise en charge dans ce navigateur.");
            }
        }

        const currentLocationButton = document.querySelector(".current-location-button");
        if (currentLocationButton) {
            currentLocationButton.addEventListener("click", addCurrentLocationMarker);
        }
    });
</script>





<script>
    document.addEventListener("DOMContentLoaded", function () {
        const errorMessage = document.getElementById("popup-error-message");

        @if (session('codeError'))
            errorMessage.innerText = "{{ session('codeError') }}";
            errorMessage.style.display = "block"; // Show the error message
        @endif
    });
</script>
