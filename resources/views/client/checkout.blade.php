@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')

<!-- Cart Items Start -->
<div class="section">
    <div class="container">
        <div id="container_details">
            <h3>Your Cart</h3>
            @if (count($cartItems) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
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
                            <tr>
                                <td><img src="{{ asset($cartItem['image']) }}" alt="product"></td>
                                <td>{{ $cartItem['name'] }}</td>
                                <td>{{ $cartItem['unityPrice'] }}$</td>
                               
                                <td>
                                @if (isset($cartItem['options']))
                                {{ $cartItem['options'] }}
                        @endif
                                </td>
                                <td>
                                    {{ $cartItem['quantity'] }}
                                    <!--<button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="decrease">-</button>
                                    <input type="number" name="quantity[{{ $cartItem['id'] }}]" id="quantity_{{ $cartItem['id'] }}" value="{{ $cartItem['quantity'] }}" min="1" max="100">
                                    <button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="increase">+</button>
--> </td>
                                <td>{{ $cartItem['price'] }}$</td>
                                <td><button>Annuler </button></td>
                            </tr>
                        @endforeach
                        <tr class="total">
                  <td>
                    <h6 class="mb-0">Grand Total</h6>
                  </td>
                  <td></td>
                  <td> <strong>{{ $totalPrice }}$</strong> </td>
                </tr>
                    </tbody> 
                </table>
                @if (auth()->check())
                    <!-- Show the regular checkout form for authenticated users -->
                 
                        @csrf
                        <!-- Other form fields for delivery method, payment method, etc. -->
                        <button type="button" id="confirmOrderBtn" class="btn-custom">Confirm Order</button>
                    
                @else
              
                <div class="row">
                 <!-- Buyer Info -->
            <h4>Entrer vos détailles</h4>
              
            <div class="col-xl-7">
            <form id="checkoutForm" method="POST" action="{{ url('/checkout') }}">
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
                <label> Addresse<span class="text-danger">*</span></label>
                <input type="text" placeholder="Addresse" name="addresse" class="form-control" value="" required="">
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
                <input type="text" placeholder="Phone Number" name="num1" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 2</label>
                <input type="text" placeholder="Phone Number" name="num2" class="form-control" value="" >
              </div>
              </div>
              <div class="row">
              <div class="form-group col-xl-12">
                <label>Email Address <span class="text-danger">*</span></label>
                <input type="email" placeholder="Email Address" name="email" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-12 mb-0">
                <label>Order Notes</label>
                <textarea name="name" rows="5" class="form-control" placeholder="Order Notes (Optional)"></textarea>
              </div>
              </div>

  <!-- Cart Details and Delivery Method -->
  <div id="cartDetailsAndDeliveryMethod" >
            <!-- Show the cart details and delivery method here -->
            @if (count($livraisons) > 0)
                <h3>Choisissez la méthode de livraison</h3>
                <select id="delivery_method" name="delivery_method" class="form-control">
                    @foreach ($livraisons as $livraison)
                        @php
                            $livraisonType = \App\Models\Livraison::find($livraison->livraison_id);
                        @endphp
                        <!-- Assuming the name field for delivery method is 'id' -->
                        <option value="{{ $livraison->id }}"> {{ $livraisonType->type_methode }}</option>
                    @endforeach
                </select>
            @endif
            <br>
            </div>
        <br>
        <br>
        <!-- Payment Method -->
        <div id="paymentMethod" >
            @if (count($paiments) > 0)
                <h3>Choisissez le mode de paiement</h3>
                <select name="payment_method" class="form-control">
                    @foreach ($paiments as $paiment)
                        @php
                            $paimentType = \App\Models\PaimentMethod::find($paiment->id);
                        @endphp
                        <!-- Assuming the name field for payment method is 'id' -->
                        <option value="{{ $paiment->id }}">{{ $paimentType->type_methode }}</option>
                    @endforeach
                </select>
            @endif
            <br>
          
           
        </div>

              <div class="form-group col-xl-12 mb-0">
              <p class="small">Your personal data will be used to process your order <a class="btn-link" href="#">privacy policy.</a> </p>
            <button type="submit" form="checkoutForm" class="btn-custom">Confirmer</button>
            </div>
            </form>
              </div>
             
             
            <!-- /Buyer Info -->
            <div class="col-xl-5 ">
         
              

   
      <div class="auth-wrapper">

       
                    <div class="auth-form">
                        <!-- Show the registration form for non-authenticated users -->
                        <h3>Créer un compte</h3>
                            <form method="POST" id="registrationForm"  action="{{ url('/register-and-checkout') }}">
                                @csrf
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control form-control-light @error('name') is-invalid @enderror" name="name" placeholder="Votre nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="prenom" type="text" class="form-control form-control-light @error('prenom') is-invalid @enderror" name="prenom" placeholder="Votre prénom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="addresse" type="text" class="form-control form-control-light @error('addresse') is-invalid @enderror" name="addresse" placeholder="Votre Addresse" value="{{ old('addresse') }}" required autocomplete="addresse" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="codePostal" type="text" class="form-control form-control-light @error('codePostal') is-invalid @enderror" name="codePostal" placeholder="Votre codePostal" value="{{ old('codePostal') }}" required autocomplete="codePostal" autofocus>
                                        @error('codePostal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="ville" type="text" class="form-control form-control-light @error('ville') is-invalid @enderror" name="ville" placeholder="Votre ville " value="{{ old('ville') }}" required autocomplete="ville" autofocus>
                                        @error('ville')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-light @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                    <input id="phone" type="text" class="form-control form-control-light @error('phone') is-invalid @enderror" name="phone" placeholder="Numero Telephone" value="{{ old('phone') }}" required autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                    <input id="phone2" type="text" class="form-control form-control-light @error('phone2') is-invalid @enderror" name="phone2" placeholder="Numero Telephone 2" value="{{ old('phone2') }}"  autocomplete="phone2">
                                    @error('phone2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                            <input id="password" type="password" class="form-control form-control-light @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                                    
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control form-control-light" name="password_confirmation" placeholder="Confirmation Mot de passe" required autocomplete="new-password">
                                    </div>
                                            <button type="button" id="registerAndCheckoutBtn" class="btn-custom">S'inscrire et payer</button>
                                            <p>Vous avez déjà un compte? <a href="{{ route('client.login') }}">Connexion</a> </p>         
                                    
                                        </div>
</form>  

                                                                        
                @endif
            @else
                <p>Aucun article dans le panier.</p>
            @endif
        </div>
        
        </div>  
        
    </div>
  
        
        <!-- Payment Method -->
        <!-- Cart Details and Delivery Method -->
        <div id="cartDetailsAndDeliveryMethod" style="display: none;">
            <!-- Show the cart details and delivery method here -->
            @if (count($livraisons) > 0)
                <h3>Choisissez la méthode de livraison</h3>
                <select id="delivery_method" name="delivery_method" class="form-control">
                    @foreach ($livraisons as $livraison)
                        @php
                            $livraisonType = \App\Models\Livraison::find($livraison->livraison_id);
                        @endphp
                        <!-- Assuming the name field for delivery method is 'id' -->
                        <option value="{{ $livraison->id }}"> {{ $livraisonType->type_methode }}</option>
                    @endforeach
                </select>
            @endif
            <br>
            <!-- Add form fields and buttons for the delivery method selection -->
            <button type="button" id="confirmDeliveryMethodBtn" class="btn-custom">confirmer la méthode de livraison</button>
        </div>
        <br>
        <br>
        <!-- Payment Method -->
        <div id="paymentMethod" style="display: none;">
            @if (count($paiments) > 0)
                <h3>Choisissez le mode de paiement</h3>
                <select name="payment_method" class="form-control">
                    @foreach ($paiments as $paiment)
                        @php
                            $paimentType = \App\Models\PaimentMethod::find($paiment->id);
                        @endphp
                        <!-- Assuming the name field for payment method is 'id' -->
                        <option value="{{ $paiment->id }}">{{ $paimentType->type_methode }}</option>
                    @endforeach
                </select>
            @endif
            <br>
            <!-- Show the payment method form fields here -->
            <button type="submit" form="checkoutForm" class="btn-custom">Vérifier</button>

           
        </div>
    </div>
</div>
<!-- Cart Details and Delivery Method -->
<!-- Cart Details and Delivery Method -->



<script>
    // JavaScript to handle form visibility toggling
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');
    const cartDetailsAndDeliveryMethod = document.getElementById('cartDetailsAndDeliveryMethod');
    const confirmDeliveryMethodBtn = document.getElementById('confirmDeliveryMethodBtn');
    const paymentMethod = document.getElementById('paymentMethod');
    const container_details = document.getElementById('container_details');
    const registerAndCheckoutBtn = document.getElementById('registerAndCheckoutBtn');
    const successMessage = document.getElementById('successMessage');


    // Show cart details and delivery method section when "Confirm Order" is clicked
    if (confirmOrderBtn) {
            confirmOrderBtn.addEventListener('click', () => {
            confirmOrderBtn.style.display = 'none';
            container_details.style.display = 'none';
            cartDetailsAndDeliveryMethod.style.display = 'block';
            
        });
    }



    if (confirmDeliveryMethodBtn) { // Check if the button element exists
        confirmDeliveryMethodBtn.addEventListener('click', () => {
      
        const formData = new FormData(checkoutForm);

fetch("{{ url('/checkout') }}", {
  method: 'POST',
  body: formData
})
.then(response => response.json())
.then(data => {
  if (data.success) {
    //registrationForm.style.display = 'none';
   // successMessage.style.display = 'block';
    // Continue with the rest of the checkout process here
  } else {
    // Handle any registration errors here if needed
    console.error(data.error); // Display the error message sent from the server
  }
})
.catch(error => {
  console.error(error);
  // Handle any errors that may occur during the registration
});

    });}





    // Show payment method section when "Confirm Delivery Method" is clicked
    if (registerAndCheckoutBtn) {
  registerAndCheckoutBtn.addEventListener('click', () => {
    const formData = new FormData(registrationForm);

    fetch("{{ url('/register-and-checkout') }}", {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        registrationForm.style.display = 'none';
        successMessage.style.display = 'block';
        // Continue with the rest of the checkout process here
      } else {
        // Handle any registration errors here if needed
        console.error(data.error); // Display the error message sent from the server
      }
    })
    .catch(error => {
      console.error(error);
      // Handle any errors that may occur during the registration
    });
  });
}
   
    document.addEventListener('DOMContentLoaded', function () {
            // Attach click event listener to the quantity buttons
            const quantityButtons = document.querySelectorAll('.btn-quantity');
            quantityButtons.forEach(button => {
                button.addEventListener('click', handleQuantityUpdate);
            });
    });

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

    // Function to update the quantity in the session
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
   </script>
<!-- Cart Items End -->

@include('client.layouts.footer_client')
