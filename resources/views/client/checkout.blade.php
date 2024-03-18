@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')
  
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
   /* Style the social login buttons */
.btn-social {
    text-align: left; /* Align the icon and text to the left */
    margin-right: 10px; /* Add space to the right of the first button */
	 border-radius: 9999px;
}

/* Adjust the icon size */
.btn-social i {
    font-size: 24px; /* Adjust the size as needed */
    margin-right: 10px; /* Add space between the icon and text */
	
    border-radius: 9999px;
   
	}
	.fa-google {
  background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;

}


</style>
<!-- Cart Items Start -->
<div class="section">
    <div class="container">
        <div id="container_details">
			<br>
			<br>
			<br>
            <h3>Votre Panier</h3>
			
            @if (count($cartItems) > 0)
			<div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            
                            <th>Nom</th>
                            <th>Prix unitaire</th>
                           
                            
                            <th>Options</th>
                            <th>Quantity</th>
                            <th>Prix total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $index => $cartItem)
                            <tr data-product-id="{{ $cartItem['id'] }}">
                               
                                <td>{{ $cartItem['name'] }}</td>
                                <td>{{ $cartItem['unityPrice'] }} €</td>
                               
                                <td>
                                    @if ((isset($cartItem['options'])) &&($cartItem['options'] != []))
                                    {{$cartItem['options']}}
                                @endif
                                </td>
                                <td>
                                    {{ $cartItem['quantity'] }}
                                <!-- <button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="decrease">-</button>
                                    <input type="number" name="quantity[{{ $cartItem['id'] }}]" id="quantity_{{ $cartItem['id'] }}" value="{{ $cartItem['quantity'] }}" min="1" max="100">
                                    <button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="increase">+</button> -->
                                </td>
                                <td>{{ $cartItem['price'] }} €</td>
                                <td><button class="btn-remove" data-product-id="{{ $cartItem['id'] }}">Annuler</button></td>
                            </tr>
                        @endforeach
                        <tr class="total">
                  <td>
                    <h6 class="mb-0">Total</h6>
                  </td>
                  <td></td>
                  <td> <div class="totalprice"> <span><strong>{{ $totalPrice }} €</strong></span></div></td>
                </tr>
                    </tbody> 
                </table>
				</div>
                @if (auth('clientRestaurant')->check())


                    <!-- Show the regular checkout form for authenticated users -->
                    <form id="checkoutForm"  method="POST" action="{{ route('client.checkout1.store', ['subdomain' => $subdomain ]) }}"  class="check-validation">
                        @csrf

  <div class="row">
              <div class="form-group col-xl-6">
                <label>Nom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Nom" name="nom" class="form-control" value="{{ optional($clientRestaurant)->FirstName }}" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Prénom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Prénom" name="prenom" class="form-control" value="{{ optional($clientRestaurant)->LastName }}" required="">
              </div>
              </div>
             
              <div class="form-group col-xl-12">
                <label> Adresse<span class="text-danger">*</span></label>
                <input type="text" placeholder="Adresse" name="adresse" class="form-control" value="{{ optional($clientRestaurant)->Address }}" required="">
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Code Postal<span class="text-danger">*</span></label>
                <input type="text" placeholder="Code Postal" name="codePostal" class="form-control" value="{{ optional($clientRestaurant)->codepostal }}">
              </div>
              <div class="form-group col-xl-6">
                <label>Ville <span class="text-danger">*</span></label>
                <input type="text" placeholder="Ville" name="ville" class="form-control" value="{{ optional($clientRestaurant)->ville }}" required="">
              </div>
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 1<span class="text-danger">*</span></label>
                <input type="text" placeholder="Numéro de téléphone " name="num1" class="form-control" value="{{ optional($clientRestaurant)->phoneNum1 }}" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 2</label>
                <input type="text" placeholder="Numéro de téléphone " name="num2" class="form-control" value="{{ optional($clientRestaurant)->phoneNum2 }}" >
              </div>
              </div>
                         <!-- Cart Details and Delivery Method -->
 <div id="cartDetailsAndDeliveryMethod">
    @if (count($livraisons) > 0)
        <h3>Choisissez la méthode de livraison</h3>
        <div class="select-wrapper">
            <select id="delivery_method" name="delivery_method" class="form-control">
                <option value="" disabled hidden selected>&#9660; Sélectionner la méthode de livraison</option> <!-- Default message with down arrow symbol -->
                @foreach ($livraisons as $livraison)
                    @if ($livraison)
                        @php
                            $livraisonType = \App\Models\Livraison::find($livraison->livraison_id);
                        @endphp
                        <option value="{{ $livraisonType->id }}" data-method="{{ $livraisonType->methode }}">{{ $livraisonType->methode }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <br>
        <div id="delivery-time-container" style="display: none;">
            <label for="delivery_time">Choisissez l'heure de livraison :</label>
            <select id="delivery_time" name="delivery_time" class="form-control">
                <option value="" disabled selected>Sélectionnez une heure</option>
            </select>
        </div>

        <script>
            document.getElementById('delivery_method').addEventListener('change', function () {
                var deliveryMethod = this.value;
                var selectedOption = this.options[this.selectedIndex];
                var deliveryTimeContainer = document.getElementById('delivery-time-container');

                var dataMethod = selectedOption.getAttribute('data-method');
                var deliveryTypeId = selectedOption.value;
                console.log('Delivery Method:', dataMethod);
                if (dataMethod === "Click & Collect") {
                    deliveryTimeContainer.style.display = 'block';
                    deliveryTimeSelect.setAttribute('required', 'required');
                    console.log('Delivery Method:', dataMethod);
                    console.log('Delivery Type ID:', deliveryTypeId);
                } else {
                    deliveryTimeContainer.style.display = 'none';
                    deliveryTimeSelect.removeAttribute('required');
                }
            });

            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();

            for (let hour = currentHour; hour <= 23; hour++) {
                for (let minute = 0; minute <= 45; minute += 15) {

                    const formattedHour = hour.toString().padStart(2, '0');
                    const formattedMinute = minute.toString().padStart(2, '0');

                    const option = document.createElement('option');
                    option.value = `${formattedHour}:${formattedMinute}`;
                    option.text = `${formattedHour}:${formattedMinute}`;

                    document.getElementById('delivery_time').appendChild(option);
                }
            }
        </script>
    @endif
</div>

   
      <!-- Payment Method -->
<div id="paymentMethod">
    @if (count($paiments) > 0)
        <h3>Choisissez le mode de paiement</h3>
        <div class="select-wrapper">
            <select id="payment_method" name="payment_method" class="form-control">
                <option value="" disabled hidden selected>&#9660; Sélectionner le mode de paiement</option> <!-- Default message with down arrow symbol -->
                @foreach ($paiments as $paiment)
                    @php
                        $paimentType = \App\Models\PaimentMethod::find($paiment->paiment_id);
                    @endphp
                    <!-- Assuming the name field for the payment method is 'id' -->
                    <option value="{{ $paimentType->id }}" data-method="{{$paimentType->type_methode}}">{{ $paimentType->type_methode }}</option>
                @endforeach
            </select>
        </div>

    @endif

    <br>
</div>
		


                        <!-- Other form fields for delivery method, payment method, etc. -->
						  <button type="submit"   class="btn-custom" id="btncustom" onclick="return validateForm()">Confirmer</button>
                       
                        </form>
				
			<script>
function validateForm() {
    var deliveryMethod = document.getElementById('delivery_method').value;
    var paymentMethod = document.querySelector('#paymentMethod select[name="payment_method"]').value;

    if (deliveryMethod === "" && paymentMethod === "") {
        alert("Veuillez sélectionner une méthode de livraison et un mode de paiement avant de confirmer la commande.");
        return false; // Prevent form submission
    } else if (deliveryMethod === "") {
        alert("Veuillez sélectionner une méthode de livraison avant de confirmer la commande.");
        return false; // Prevent form submission
    } else if (paymentMethod === "") {
        alert("Veuillez sélectionner un mode de paiement avant de confirmer la commande.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
</script>
                @else
              
                <div class="row">
                 <!-- Buyer Info -->
            <h4>Entrer vos détailles</h4>
              
            <div class="col-xl-7">
            <form id="checkoutForm"  method="POST" action="{{ route('client.checkout1.store', ['subdomain' => $subdomain ]) }}"  class="check-validation">
            @csrf
            <div class="row">
              <div class="form-group col-xl-6">
                <label>Nom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Nom" name="nom" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Prénom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Prénom" name="prenom" class="form-control" value="" required="">
              </div>
              </div>
             
              <div class="form-group col-xl-12">
                <label> Adresse<span class="text-danger">*</span></label>
                <input type="text" placeholder="Adresse" name="adresse" class="form-control" value="" required="">
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Code Postal<span class="text-danger">*</span></label>
                <input type="text" placeholder="Code Postal" name="codePostal" class="form-control" value="">
              </div>
              <div class="form-group col-xl-6">
                <label>Ville <span class="text-danger">*</span></label>
                <input type="text" placeholder="Ville" name="ville" class="form-control" value="" required="">
              </div>
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 1<span class="text-danger">*</span></label>
                <input type="text" placeholder="Numéro de téléphone " name="num1" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 2</label>
                <input type="text" placeholder="Numéro de téléphone " name="num2" class="form-control" value="" >
              </div>
              </div>
              <div class="row">
              
             <!-- <div class="form-group col-xl-12 mb-0">
                <label>Order Notes</label>
                <textarea name="name" rows="5" class="form-control" placeholder="Order Notes (Optional)"></textarea>
              </div>-->
              <br>
              <div class="form-group">
                <input id="checkbox" name="creer_un_compte" type="checkbox" class="form-control-light">
                <label>Créer un compte</label>
            </div>
            <div id="accountFields" style="display: none;">
                <div class="form-group col-xl-12">
                    <label>Adresse Email  <span class="text-danger">*</span></label>
                    <input type="email" placeholder=" Adresse Email" name="email" class="form-control" value="" >
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="text-danger">*</span></label>
                 
                    <input id="password" type="password" class="form-control form-control-light" name="password" placeholder="Mot de passe"  autocomplete="new-password">
                </div>
              
            </div>
        
       
              <p>Vous avez déjà un compte? <a href="{{ route('client.login', ['subdomain' => $subdomain]) }}">Connexion</a> </p>    
				  <div class="form-group">
                  <a href="{{ route('register.google', ['subdomain' => $subdomain]) }}" class="btn  btn-social">
            <i class="fab fa-google  fa-6x"></i> Se connecter avec Google
        </a>
    
    
</div>
                                    
              </div>

  <!-- Cart Details and Delivery Method -->
<div id="cartDetailsAndDeliveryMethod">
    @if (count($livraisons) > 0)
        <h3>Choisissez la méthode de livraison</h3>
        <div class="select-wrapper">
            <select id="delivery_method" name="delivery_method" class="form-control">
                <option value="" disabled hidden selected>&#9660; Sélectionner la méthode de livraison</option> <!-- Default message with down arrow symbol -->
                @foreach ($livraisons as $livraison)
                    @if ($livraison)
                        @php
                            $livraisonType = \App\Models\Livraison::find($livraison->livraison_id);
                        @endphp
                        <option value="{{ $livraisonType->id }}" data-method="{{ $livraisonType->methode }}">{{ $livraisonType->methode }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <br>
        <div id="delivery-time-container" style="display: none;">
            <label for="delivery_time">Choisissez l'heure de livraison :</label>
            <select id="delivery_time" name="delivery_time" class="form-control">
                <option value="" disabled selected>Sélectionnez une heure</option>
            </select>
        </div>

        <script>
            document.getElementById('delivery_method').addEventListener('change', function () {
                var deliveryMethod = this.value;
                var selectedOption = this.options[this.selectedIndex];
                var deliveryTimeContainer = document.getElementById('delivery-time-container');

                var dataMethod = selectedOption.getAttribute('data-method');
                var deliveryTypeId = selectedOption.value;
                console.log('Delivery Method:', dataMethod);
                if (dataMethod === "Click & Collect") {
                    deliveryTimeContainer.style.display = 'block';
                    deliveryTimeSelect.setAttribute('required', 'required');
                    console.log('Delivery Method:', dataMethod);
                    console.log('Delivery Type ID:', deliveryTypeId);
                } else {
                    deliveryTimeContainer.style.display = 'none';
                    deliveryTimeSelect.removeAttribute('required');
                }
            });

            const now = new Date();
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();

            for (let hour = currentHour; hour <= 23; hour++) {
                for (let minute = 0; minute <= 45; minute += 15) {

                    const formattedHour = hour.toString().padStart(2, '0');
                    const formattedMinute = minute.toString().padStart(2, '0');

                    const option = document.createElement('option');
                    option.value = `${formattedHour}:${formattedMinute}`;
                    option.text = `${formattedHour}:${formattedMinute}`;

                    document.getElementById('delivery_time').appendChild(option);
                }
            }
        </script>
    @endif
</div>


       
      <!-- Payment Method -->
<div id="paymentMethod">
    @if (count($paiments) > 0)
        <h3>Choisissez le mode de paiement</h3>
        <div class="select-wrapper">
            <select id="payment_method" name="payment_method" class="form-control">
                <option value="" disabled hidden selected>&#9660; Sélectionner le mode de paiement</option> <!-- Default message with down arrow symbol -->
                @foreach ($paiments as $paiment)
                    @php
                        $paimentType = \App\Models\PaimentMethod::find($paiment->paiment_id);
                    @endphp
                    <!-- Assuming the name field for the payment method is 'id' -->
                    <option value="{{ $paimentType->id }}" data-method="{{$paimentType->type_methode}}">{{ $paimentType->type_methode }}</option>
                @endforeach
            </select>
        </div>
	
	

    @endif

    <br>
</div>

				

				
				
				
              <div class="form-group col-xl-12 mb-0">
            
				  
    <button type="submit"   class="btn-custom" id="btncustom" onclick="return validateForm()">Confirmer</button>
				  
           
            </div>
            </form>
				
				<script>
function validateForm() {
    var deliveryMethod = document.getElementById('delivery_method').value;
    var paymentMethod = document.querySelector('#paymentMethod select[name="payment_method"]').value;

    if (deliveryMethod === "" && paymentMethod === "") {
        alert("Veuillez sélectionner une méthode de livraison et un mode de paiement avant de confirmer la commande.");
        return false; // Prevent form submission
    } else if (deliveryMethod === "") {
        alert("Veuillez sélectionner une méthode de livraison avant de confirmer la commande.");
        return false; // Prevent form submission
    } else if (paymentMethod === "") {
        alert("Veuillez sélectionner un mode de paiement avant de confirmer la commande.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
</script>
              </div>
             
           
     
 

                                                                        
                @endif

	
            @else
                <p>Aucun article dans le panier.</p>
            @endif
        </div>
        
        </div>  
		
	
		
        <div id="CartBancaire" name="CartBancaire" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <div class="panel panel-default credit-card-box" style="border: 2px solid #ccc; padding: 20px;">
                    <div class="panel-heading display-table">
                        <h3 class="panel-title">Détails de paiement</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12'>
                                    <i class="fab fa-cc-mastercard fa-2x card-icon" title="Mastercard"></i>
                                    <i class="fab fa-cc-visa fa-2x card-icon" title="Visa"></i>
                                    <i class="fab fa-cc-amex fa-2x card-icon" title="American Express"></i>
                                    <i class="fab fa-cc-discover fa-2x card-icon" title="Discover"></i>
                                    <i class="fab fa-cc-diners-club fa-2x card-icon" title="Diners Club"></i>
                                    <i class="fab fa-cc-jcb fa-2x card-icon" title="JCB"></i>
                                    <!-- Add more card icons for other card types here -->
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Nom sur la Carte</label>
                                    <input class='form-control' size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form group  required'>
                                    <label class='control-label'>Numéro de Carte</label>
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Mois d'expiration</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Année d'expiration</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class="col-md-12 error form-group hide">
    <div class="alert-danger alert"></div>
</div>

                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block btn-cart">Payer et Confirmer <b>{{$totalPrice}} €</b></button>
                                </div>
                                <div class="col-xs-12">
                                    <div class="mb-4"></div>
                                    <button class="btn btn-danger btn-lg btn-block" type="button" onclick="goBack()">Annuler</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
				 
<br/>
	<br/>
  
</div>
</div>
<!-- Cart Details and Delivery Method -->

 <script>
    function goBack() {
      //  window.history.back();
		 var detailscustom = document.getElementById('container_details');
        
         var CartBancaireContainer = document.getElementById('CartBancaire');
       
            CartBancaireContainer.style.display = 'none';
            
            detailscustom.style.display = 'block';
    }
</script>

    
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript to handle form visibility toggling
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');
    const cartDetailsAndDeliveryMethod = document.getElementById('cartDetailsAndDeliveryMethod');
    const confirmDeliveryMethodBtn = document.getElementById('confirmDeliveryMethodBtn');
    const paymentMethod = document.getElementById('paymentMethod');
    const container_details = document.getElementById('container_details');
    const registerAndCheckoutBtn = document.getElementById('registerAndCheckoutBtn');
    const successMessage = document.getElementById('successMessage');
   $(document).ready(function () {
        $(".btn-remove").click(function () {
            var button = $(this); // Get the clicked button
            var row = button.closest("tr");
            var productId = row.attr("data-product-id");
            
            $.ajax({
                url: '{{ route("remove.CartItem", ["subdomain" => $subdomain]) }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            productId: productId,
        },
                success: function (response) {
                    // Update the UI and total price based on the response
                    row.remove();
                     // Update the cart item count in the header
     var cartItemCount = $('.cart-item-count');
    cartItemCount.text(response.cartItemCount);
                    var totalPriceElement = $('.totalprice span');
                     // Remove the row from the table
                     totalPriceElement.text(response.totalPrice + '$'); // Update total price
                },
                error: function (error) {
                    console.error('Error removing item:', error);
                    // Handle error gracefully
                }
            });
        });
    $(".btn-quantity").click(handleQuantityUpdate);

    function handleQuantityUpdate(event) {
        const productId = event.target.getAttribute('data-product');
        const action = event.target.getAttribute('data-action');
        const inputElement = document.getElementById('quantity_' + productId);

        let newQuantity = parseInt(inputElement.value);
        if (action === 'increase') {
            newQuantity++;
        } else if (action === 'decrease' && newQuantity > 1) {
            newQuantity--;
        }

        // Update the input element value immediately
        inputElement.value = newQuantity;

        // Send the updated quantity to the server
        updateQuantity(productId, newQuantity);
    }

    function updateQuantity(productId, quantity) {
    fetch('{{ route("update.quantity",["subdomain" => $subdomain]) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ productId, quantity })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        // You can update the UI here to reflect the updated quantity in the cart
    })
    .catch(error => {
        console.error(error);
        // Handle any errors that may occur during the update
    });
}
});
$(document).ready(function() {
    // Select the checkbox and the container to show/hide
    var checkbox = $('#checkbox');
    var accountFields = $('#accountFields');

    // Toggle visibility when the checkbox state changes
    checkbox.change(function() {
        if (checkbox.is(':checked')) {
            accountFields.show(); // Show the fields
        } else {
            accountFields.hide(); // Hide the fields
        }
    });
});
	
	
	

 

  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
			 var $checkform = $(".check-validation");
 $(document).ready(function () {
    var $checkform = $(".check-validation");

    $checkform.on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        var Payment = document.getElementById('payment_method');
        var PaymentMethod = Payment.value;
        var selectedOption = Payment.options[Payment.selectedIndex];
        var CartBancaireContainer = document.getElementById('CartBancaire');
        var btncustom = document.getElementById('container_details');
        var dataMethod = selectedOption.getAttribute('data-method');
        var deliveryTypeId = selectedOption.value;
        console.log('Delivery Method:', dataMethod);
        if (dataMethod === "Carte Bancaire") {
            CartBancaireContainer.style.display = 'block';
            console.log('Delivery Type ID:', deliveryTypeId);
            console.log('Delivery Method:', dataMethod);
            btncustom.style.display = 'none';
        } /*else if (dataMethod === "PayPal") {
			//var dataMethod = selectedOption.getAttribute('data-method');
var url = '{{ route("make.payment", ["subdomain" => $subdomain, "paymentMethodId" => ":paymentMethodId"]) }}';
url = url.replace(':paymentMethodId', deliveryTypeId);


$.ajax({
    url: url,
   
				 
       
        method: 'GET',
        data: {
            
           
        },
                success: function (response) {
                    $checkform.get(0).submit();
                         },
                error: function (error) {
                    console.error('Error removing item:', error);
                    // Handle error gracefully
                }
            });
		}
		*/else{
            btncustom.style.display = 'block';
            CartBancaireContainer.style.display = 'none';
        
        var formData = new FormData($checkform[0]);
console.log(formData);
     
		$checkform.get(0).submit();}
    });
 });
  $(function() {
  
   
   var  $checkform = $(".check-validation");
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
		  e.preventDefault(); // Prevent the default form submission
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
         Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');

          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
   function stripeResponseHandler(status, response) {
    if (response.error) {
        $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
		 var Payment = document.getElementById('payment_method');
        var PaymentMethod = Payment.value;
        var selectedOption = Payment.options[Payment.selectedIndex];
        
        var dataMethod = selectedOption.getAttribute('data-method');
        var paymentMethodId = selectedOption.value;
		
        var token = response.id; // Use response.id to get the token

        // Prevent the default form submission
       // e.preventDefault();

        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
		
var routeUrl = '{{ route("stripe.post", ["subdomain" => $subdomain, "paymentMethodId" => ":paymentMethodId"]) }}';
routeUrl = routeUrl.replace(':paymentMethodId', paymentMethodId);
        // Make an AJAX request to your server to process the payment
        $.ajax({
            url: routeUrl,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                stripeToken: token // Send the Stripe token to your server
            },
            success: function (response) {
                // Handle the success response from your server
                console.log('Payment successful:', response.message);
var $checkform = $(".check-validation");
             
				$checkform.get(0).submit();
				
				
            },
           error: function (error) {
                console.error('Error processing payment:', error.responseJSON.message);
                // Handle the error gracefully, e.g., show an error message to the user
            }
        });
    }
}
	 });
</script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		
<!-- Cart Items End -->

@include('client.layouts.footer_client')
