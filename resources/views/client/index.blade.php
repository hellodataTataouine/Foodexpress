@include('client.layouts.top_menu_client')
  <!-- Cart Sidebar Start -->
  @include('client.layouts.cart_client')
  <!-- Aside (Mobile Navigation) -->
  @include('client.layouts.header_menu')
 
     
  @include('client.layouts.voirmonpanier')
  
     
    

  <!-- Banner Start -->
  <style>
	  .truncate-description {
    max-height: 70px; /* Set a maximum height for the description */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.product {
    height: auto; /* Ensure card height is dynamic */
    /* Add any additional styling for the product card */
}

	  
	  
    .product-image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 300px;
		width: 300px;/* Set the desired height for the image container */
    }
	  
	  
    
    /* Adjust the image size if necessary */
    .product-image-container img {
      max-width: 100%;
      max-height: 100%;
    }
	  .product-thumb img.customizeBtn {
    cursor: pointer;
}
	  
      </style>
  <!-- Banner End -->
 <!-- Customize Modal Start -->
 <div class="modal fade" id="customizeModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
		
          <div class="modal-header modal-bg">
              <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
            <span></span>
            <span></span>
          </button>
          </div>
          <div class="modal-body">
            <div class="customize-meta">
              <h4 class="customize-title"><span class="custom-primary">Prix total:</span> </h4>
              <p ></p>
            </div>
            <div class="customize-variations">
              <div class="customize-size-wrapper">
                <!-- Size variations -->
              </div>
              <div class="row">
              </div>
              <!-- Other customization options -->
            </div>
            <div class="customize-controls">
              <div class="qty">
                <span class="qty-subtract"><i class="fas fa-minus"></i></span>
              <input type="number"   name="totalquantity"  id="totalquantity" value="1" min="1" readonly>
              <span class="qty-add"><i class="fas fa-plus"></i></span>
              </div>
              <div class="customize-total" >
                <h5 >Prix : <span class="final-price custom-primary"> <span>€</span> </span> </h5>
              </div>
             
            </div>
			
      
           </div>
				
        </div>
      </div>
    </div>
  <!-- Customize Modal End -->


 <!--<div class="banner banner-3">

    <div class="banner-slider-3">
 @foreach ($paginator as $product)  
      <div class="banner-item">
		

<div class="banner-inner" style="background-image: url('{{ asset($product->url_image) }}'); height: 600px; width: 800px;">
  

			   <h1 class="title">{{ $product->nom_produit }} </h1>
			  
			   <div class="banner-text">
            <p class="subtitle">
              {{ $product->description }}.
            </p>
            <div class="banner-icons-wrapper">
              <div class="banner-icon">
                <i class="flaticon-broccoli"></i>
                <div class="banner-icon-body">
                
                  
                </div>
              </div>
              <div class="banner-icon">
                <i class="flaticon-online-booking"></i>
                <div class="banner-icon-body">
                  
                </div>
              </div>
            </div>
            <div class="banner-controls">
            <a class="btn-custom primary customizeBtn" data-bs-toggle="modal" data-bs-target="#customizeModal"
                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom_produit }}"
                        data-product-image="{{ asset($product->url_image) }}" data-product-price="{{ $product->prix }}"
                        >Commander <i class="fas fa-shopping-cart"></i></a>
              <h4>{{ $product->prix }} €</h4>
            </div>
          </div>
			  
			  
			  
		   </div>
		       
		  
   </div>
		  @endforeach
		
      </div>
   
    <div class="ct-arrows-wrapper">
      <div class="slide-number">
        <span class="current-slide">0<span>1</span></span> <span>/4</span>
      </div>
      <div class="ct-arrows">
        <div class="slider-prev">
          Previous
        </div>
        <div class="slider-next">
          Next
        </div>
      </div>
    </div>

  </div> -->

<!-- Menu Categories Start -->

<div class="ct-menu-categories menu-filter">
  
    <div class="container">
      
      <div class="menu-category-slider">
        
        <a href="#" data-filter="*" class="ct-menu-category-item ">
          <div class="menu-category-thumb">
            <img src="{{ $client->Category_photo }}" alt="category" >
          </div>
          <div class="menu-category-desc">
           <!-- <h6>Tous</h6>-->
          </div>
        </a>
    @foreach($categories->sortBy('RowN') as $index => $category)
          @if(isset($firstProducts[$category->id]))
              @php
                  $firstProduct = $firstProducts[$category->id];
              @endphp

            <a href="#" data-filter=".{{ $category->id }}" class="ct-menu-category-item {{ $index === 0 ? 'active' : '' }}">
          <div class="menu-category-thumb">
            <img src="{{ $category->url_image }}" alt="category" style="height: 86px; width: 86px;">
          </div>
          <div class="menu-category-desc">
          <!--  <h6>{{ $category->name }}</h6> -->
          </div>
        </a>
        @endif
    @endforeach
    
      </div>
        <div class="swiper-button-next start">
        </div>
        <div class="swiper-button-prev end">
        </div>
        
      
    
  </div>
  {{-- <div class="swiper-button-prev"><i class="fas fa-angle-double-left"></i></div>
       <div class="swiper-button-next"><i class="fas fa-angle-double-right"></i></div> --}}
</div>
  <!-- Menu Categories End -->
 <!-- Menu Wrapper Start -->
 <div class="section section-padding">
    <div class="container">

      <div class="menu-container row">
 <!-- Product Start -->
		  
 @foreach ($paginator as $product)
     
        <!-- Product Start -->
		  
      <div class="col-lg-3 col-md-6 {{ $product->categorie_rest_id}}">
          <div class="product">
            <div>
                <i class="far fa-heart" style="color: white;"></i>
            </div>

            <a class="product-thumb">
                <img class="customizeBtn" data-bs-toggle="modal" data-bs-target="#customizeModal"
                    data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom_produit }}"
                    data-product-image="{{ asset($product->url_image) }}" data-product-price="{{ $product->prix }}"
                    src="{{ asset($product->url_image) }}" alt="menu item" class="center"
                    style="height: 296px; width: 296px;" />
            </a>

            <div class="product-body">
                <div class="product-desc">
                    <h4 class="truncate-description"> {{ $product->nom_produit }} </h4>
                    <div class="ct-rating-wrapper">
                    </div>
                    @if($product->description != "")
                    <p class="truncate-description" >{{ $product->description }}</p>
                    @else
                    <br><br>
                    @endif
                    <p class="product-price">{{ $product->prix }} €</p>
                    <a class="btn-custom btn-sm shadow-none customizeBtn" data-bs-toggle="modal" data-bs-target="#customizeModal"
                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom_produit }}"
                        data-product-image="{{ asset($product->url_image) }}" data-product-price="{{ $product->prix }}"
                        >Commander <i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
        </div>
				
        @endforeach
        <!-- Product End -->

      </div>
    </div>
  </div>
  <!-- Menu Wrapper End -->
  <!-- Newsletter start -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
		toastr.options = {
  closeButton: true,                // Show a close button
  timeOut: 2000,                    // Close the notification after 3 seconds
  positionClass: 'toast-top-right',
  backgroundColor: '#FCCC4C',
		//progressBar: true,// Set the notification background color (with quotes)
};


</script>
<script>
// const slides = document.querySelectorAll(".menu-category-thumb");
// let currentSlide = 0;

// function showSlide(index) {
//   slides.forEach((slide, i) => {
//     if (i === index) {
//       slide.style.opacity = 100;
//     } else {
//       slide.style.opacity = 100;
//     }
//   });
// }

// function nextSlide() {
//   currentSlide = (currentSlide + 1) % slides.length;
//   showSlide(currentSlide);
// }

// function prevSlide() {
//   currentSlide = (currentSlide - 1 + slides.length) % slides.length;
//   showSlide(currentSlide);
// }

// // showSlide(currentSlide);
// var swiper = new Swiper('.menu-category-slider', {
//       slidesPerView: 3,
//       slidesPerGroup: 3,
//       spaceBetween: 20,
//       navigation: {
//         nextEl: '.swiper-button-prev',
//         prevEl: '.swiper-button-next',
//       },
//       breakpoints: {
//         960: {
//           slidesPerView: 5,
//         }
//       }
//     });

</script>
  <script>
	  var selectedOptionsproduits = [];
	   var selectedOptions = {};
    var response; // Global variable to store the response object

    $(document).ready(function() {
      $('.customizeBtn').click(function() {
        var productId = $(this).data('product-id');
        var productOptions = $(this).data('data-product-options');
        $.ajax({
          url: '/panier/getProductRestaurantDetails/' + productId,
          method: 'GET',
          success: function(res) {
            response = res; // Store the response in the global variable
           
            $('.customize-title').empty();
            $('.customize-meta p').empty();
            $('.modal-header').empty();
            $('.customize-variations').empty();
            $('.custom-primary').empty();
            $('.final-price.custom-primary').empty();
            // Update the modal content with the returned data
            
            $('.customize-title').html(response.product.nom_produit + ' <span class="custom-primary">'  + response.product.prix + '€</span>');
                var $pElement = $('.customize-meta p');

// Add text to the <p> element
			 
$pElement.text(response.product.description);
            // Update the background image
           // $('.modal-header').css('background-image', 'url("' + response.product.url_image + '")');
  $('.modal-header').css({
    'background-image': 'url("' + response.product.url_image + '")',
    'height': '406px',
   
});
           
           $('.customize-variations').empty();
            for (var i = 0; i < response.familleOptions.length; i++) {
              var familleOption = response.familleOptions[i];
              var options = familleOption.options;
  
              if (i % 3 === 0) {
                // Create a new row
                var row = $('<div class="row"></div>');
                row.appendTo('.customize-variations');
              }
  
              var variationElement = $('<div class="col-lg-4 col-12"></div>');
              var variationWrapper = $('<div class="customize-variation-wrapper"></div>');
              var variationTitle = $('<h5>' + familleOption.famille_option.nom_famille_option + '</h5>');
  
              variationTitle.appendTo(variationWrapper);
				if (familleOption.famille_option.nbre_choix != null && familleOption.famille_option.nbre_choix != 0 && familleOption.famille_option.type != "simple") {
		 var variationsubTitle = $('<p>' + "Choisissez-en " + familleOption.famille_option.nbre_choix +  " max." + '<p>');
  
				 variationsubTitle.appendTo(variationWrapper);
				
				}else if((familleOption.famille_option.nbre_choix == null || familleOption.famille_option.nbre_choix == 0) && (familleOption.famille_option.type == "multiple")){
					 var variationsubTitle = $('<p>' + "Choisissez-en " + familleOption.options.length +  " max." + '<p>');
  
				 variationsubTitle.appendTo(variationWrapper);
				}
				if(familleOption.famille_option.type == "simple" ){
					 var variationsubTitle = $('<p>' + "Choisissez-en 1 " + '<p>');
				 variationsubTitle.appendTo(variationWrapper);
				
				}
              variationWrapper.appendTo(variationElement);



              var aucunOption = null; 

              for (var j = 0; j < options.length; j++) {
                let option = options[j]; // Use let instead of var to correctly scope the variable
 
                var variationItem = $('<div class="customize-variation-item" data-price="' + option.prix + '"></div>');
                var variationIcon = $('<i class="flaticon-food-tray"></i>');
            
             
				    var customControl = $('<div class="custom-control custom-' + (familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox') + ' ' + generateUniqueClassName() + '"></div>');
            
                function generateUniqueClassName() {
  
  var uniqueId = new Date().getTime(); // Using a timestamp as a unique identifier
  return 'unique-' + uniqueId;
}
                var inputType = familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox';

   // Store the type of the option (checkbox or qte) in the selectedOptions object
   selectedOptions[option.id] = {
    name: option.nom_option,
    price: option.prix,
    type: familleOption.famille_option.type,
  };
                if (familleOption.famille_option.type === 'qte') {
  inputType = 'number';
  var input = $('<input type="' + inputType + '" id="' + option.id + '" name="quantity" min=0 class="custom-control-input">');
					input.css('width', '50px'); 
					// Set the height to 30 pixels
  // For "qte" type options, attach an event handler to update the quantity
  input.on('input', function() {
      var quantity = parseInt($(this).val(), 10) || 1; // Ensure a valid integer (default to 1 if invalid)
      var input = $('<input type="' + inputType + '" id="' + option.id + '" name="quantity" class="custom-control-input">');
 
      input.attr('data-option-id', option.id); // Set a data-* attribute to store option.id on the input element

  // For "qte" type options, attach an event handler to update the quantity
  input.on('input', function() {
    var optionId = $(this).data('option-id'); // Retrieve option.id from the data-* attribute
    var quantity = parseInt($(this).val(), 10) || 1; // Ensure a valid integer (default to 1 if invalid)

    // Update the quantity in the selectedOptions object using optionId
    selectedOptions[optionId].Quantity = quantity;
  });
    });
} else if (inputType === 'radio') {
	
    if (j === 0) {
            input = $('<input type="' + inputType + '" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input" checked>');
	
		// input.on('change', handledefaultchecked(familleOption));
  
        } else {
            input = $('<input type="' + inputType + '" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input">');
        }
}else if (inputType === 'checkbox') {
     var input = $('<input type="' + inputType + '" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input">');
    
    // Add an event listener to the checkbox
     input.on('change', createCheckboxChangeHandler(familleOption));
}
  var label = $('<label class="custom-control-label" for="' + option.id + '"> ' + option.nom_option + ' </label>');
  if(option.prix != null){
                var price = $('<span> +' + option.prix + '€ </span>');
  }else {
    var price = $('');
  }
                input.appendTo(customControl).css('margin-right', '7px');
                label.appendTo(customControl);
                customControl.appendTo(variationItem);
                price.appendTo(variationItem);
                variationIcon.appendTo(variationWrapper);
                variationItem.appendTo(variationWrapper);
if (option.nom_option === 'Aucun') {
        aucunOption = customControl; // Save the 'Aucun' option for later
    }
              }
if (aucunOption) {
    aucunOption.appendTo(variationWrapper);
}

              variationElement.appendTo(row);
            }
            var customizeControls = $('.customize-controls');
       
           var quantityLabel = $('.qty');
//var quantityLabel = $('<div class="qty"></div>');
var subtractButton = $('.qty-subtract');
//var quantityInput = $('<input type="number" name="totalquantity"  id="totalquantity" value="1">');
var addButton  = $('.qty-add');





var priceLabel = $('.customize-total');
    $('.final-price.custom-primary').text( response.product.prix + '€' );
          

addButton.off('click');
subtractButton.off('click');

//action
addButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity)) {
    totalquantityInput.val(currentQuantity + 1);
    updateTotalPrice(); 
  }
});
subtractButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity) && (currentQuantity > 1)) {
    totalquantityInput.val(currentQuantity - 1);
    updateTotalPrice(); 
  }
});

$('.modal-body .order-item.btn-custom.btn-sm.shadow-none.customizeBtn').remove();
		

var addToCartBtn = $('<button type="submit"  class="order-item btn-custom btn-sm shadow-none customizeBtn" data-product-id="' + productId + '" data-product-name="' + response.product.nom_produit + '" data-product-image="' + response.product.url_image + '" data-product-price="' + response.product.prix + '">Ajouter au Panier <i class="fas fa-shopping-cart"></i></button>');
addToCartBtn.appendTo('.modal-body');
			  // Create the "Cancel" button
			  $('.modal-body .btn.btn-sm.shadow-none.cancelButton').remove();
var cancelButton = $('<button type="button" class="btn btn-sm shadow-none cancelButton" data-dismiss="modal">Annuler</button>');

// Append both buttons to the modal body
$('.modal-body').append(addToCartBtn, cancelButton);
cancelButton.on('click', function() {

// Close the modal when the button is clicked
$('#customizeModal').modal('hide');
});
        // Calculate and update the total price
            updateTotalPrice();
           
            // Show the modal
            $('#customizeModal').on('shown.bs.modal', function() {
				 $('.customize-variation-wrapper input[type="radio"]:checked').each(function() {
    // Trigger the 'change' event for each initially checked radio button
    $(this).trigger('change');
  });
    //initializeTotalQuantity();
				
   
 
				 $('.final-price.custom-primary').text(response.product.prix);
  });
			   var totalquantityInput = $('#totalquantity');
    totalquantityInput.val('1');
			  
            $('#customizeModal').modal('show');
          },
          error: function(err) {
            console.log(err);
          }
        });
		  
      });
		 
     // selectedOptions = [];
		 

         $(document).on('change', '.customize-variation-wrapper input[type="checkbox"], .customize-variation-wrapper input[type="radio"], .customize-variation-wrapper input[type="number"], .customize-variations #totalquantity', function() {
  // Clear the selectedOptions array to start fresh
 // selectedOptions = [];
// Loop through the selected options to store their details
$('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
        var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat($(this).closest('.customize-variation-item').data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = 1;

        selectedOptions.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			Quantity: optionQuantity,
        });
      
    });
    
    $('.customize-variation-wrapper input[name="quantity"]').each(function() {

     
      var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());

  if(quantity >= 1){
      var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat(optionItem.data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = quantity;

  // Push the selected option's details into the selectedOptions array
        
  selectedOptions.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			      Quantity: optionQuantity,
        });
  }
    });
   
   
 // Handle quantity input if present
 var totalQuantity = parseInt($('#totalquantity').val());
    if (isNaN(totalQuantity) || totalQuantity < 1) {
        totalQuantity = 1;
    }
          // Calculate and update the total price
  updateTotalPrice();
 
      });
  
    
function createCheckboxChangeHandler(familleOption) {
   return function() {
        // Get all checkboxes in this specific familleOption group
        var checkboxes = $('input[name="' + familleOption.id + '"]');
        
        // Get the number of checkboxes selected in this group
        var selectedCount = checkboxes.filter(':checked').length;
        if (familleOption.famille_option.nbre_choix != null && familleOption.famille_option.nbre_choix != 0)
        // Check if the selectedCount exceeds the maximum allowed for this group
		{ if (selectedCount >= familleOption.famille_option.nbre_choix) {
            // Uncheck and disable checkboxes if the limit is exceeded
            checkboxes.filter(':not(:checked)').prop('disabled', true);
        } else {
            // Enable all checkboxes within the group if the limit is not exceeded
            checkboxes.prop('disabled', false);
        }}
    };
}

      // Function to calculate and update the total price
      function updateTotalPrice() {
        var totalPrice = parseFloat(response.product.prix);
        console.log('Total Price:', totalPrice);

        // Loop through the selected options
        $('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
         
          var optionPrice = $(this).closest('.customize-variation-item').data('price');
              console.log('optionPrice:', optionPrice);
         
              if (optionPrice != null) {
    
    optionPrice = parseFloat(optionPrice);
   
}else{
  optionPrice = 0;
}
          totalPrice += optionPrice;
        });
  
     // Handle quantity for options
var optionQuantity = 0;
var optionQuantityPrice = 0;

$('.customize-variation-wrapper input[name="quantity"]').each(function() {
  var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());
  if (isNaN(quantity) || quantity < 1) {
    quantity = 0;
  }


  //optionQuantity += quantity;
  if (!isNaN(optionPrice)) 
         {
  optionQuantityPrice += optionPrice * quantity;
  }
 
  console.log('Option Quantity:', quantity);
});
totalPrice += optionQuantityPrice;


console.log('Option Quantity Price:', optionQuantityPrice);

  // Handle quantity for total price
  var totalPriceQuantity = 1;
  var totalPriceQuantityInput = $('#totalquantity');
  if (totalPriceQuantityInput.length > 0) {
    totalPriceQuantity = parseInt(totalPriceQuantityInput.val());
    if (isNaN(totalPriceQuantity) || totalPriceQuantity < 1) {
      totalPriceQuantity = 1;
    }
  }


 

  // Update the total price based on the quantities
  totalPrice *= totalPriceQuantity;

  //var addToCartBtn = $('.order-item');
   // addToCartBtn.attr('data-product-price', totalPrice);
        // Update the total price display
        $('.total-price').html(totalPrice + '€');
       
        var priceTotal = $('.final-price.custom-primary');
        priceTotal.text(totalPrice.toFixed(2) + '€');
      
      }

      $('.close-btn').on('click', function() {
    $('#customizeModal').modal('hide');

  });
   $('#customizeModal').on('hidden.bs.modal', function () {
    // Set the text of the element with class 'final-price.custom-primary' to an empty string
    $('.final-price.custom-primary').text("");
	    selectedOptions = [];
  });
 
});

	  
	  
	  
	  
	    $(document).ready(function() {
      $(document).on("click", ".customizeBtnedit", function () {
        var productIdAdd = $(this).data('product-id');
		  var  productIdEdit = $(this).data('product-id-edit');
		  var productquantity = $(this).data('product-qauntity');
		  var productprix = $(this).data('product-price');
		  var productitem = $(this).data('product-item');
		
         var encodedString = $(this).data('product-options');
		  console.log(encodedString);
if (encodedString !== null && encodedString !== undefined && (typeof encodedString === 'string' || Array.isArray(encodedString))) {
    // Parse the JSON string directly
	 if (typeof encodedString === 'string') {
        var productOptionsedit = JSON.parse(encodedString);
        var productOptions = productOptionsedit.replace(/\([^)]*\)/g, '');
        console.log(productOptions);
      } 
}
		   // Initialize selectedOptions as an empty array
    //var selectedOptions = [];
		  if (productIdEdit !== undefined) {
      productId = productIdEdit; 
    } else {
      productId = productIdAdd; 
    }
        $.ajax({
          url: '/panier/getProductRestaurantDetails/' + productId,
          method: 'GET',
          success: function(res) {
            response = res; // Store the response in the global variable
          //  var selectedOptions = {};
            $('.customize-title').empty();
            $('.customize-meta p').empty();
            $('.modal-header').empty();
            $('.customize-variations').empty();
            $('.custom-primary').empty();
            $('.final-price.custom-primary').empty();
            // Update the modal content with the returned data
            
            $('.customize-title').html(response.product.nom_produit + ' <span class="custom-primary">'  + response.product.prix + '€</span>');
                var $pElement = $('.customize-meta p');

// Add text to the <p> element
			 
$pElement.text(response.product.description);
            // Update the background image
            $('.modal-header').css('background-image', 'url("' + response.product.url_image + '")');
  
           
           $('.customize-variations').empty();
            for (var i = 0; i < response.familleOptions.length; i++) {
              var familleOption = response.familleOptions[i];
              var options = familleOption.options;
  
              if (i % 3 === 0) {
                // Create a new row
                var row = $('<div class="row"></div>');
                row.appendTo('.customize-variations');
              }
  
              var variationElement = $('<div class="col-lg-4 col-12"></div>');
              var variationWrapper = $('<div class="customize-variation-wrapper"></div>');
              var variationTitle = $('<h5>' + familleOption.famille_option.nom_famille_option + '</h5>');
  
              variationTitle.appendTo(variationWrapper);
				if (familleOption.famille_option.nbre_choix != null && familleOption.famille_option.nbre_choix != 0) {
		 var variationsubTitle = $('<p>' + "Choisissez-en " + familleOption.famille_option.nbre_choix +  " max." + '<p>');
  
				 variationsubTitle.appendTo(variationWrapper);
				
				}else if((familleOption.famille_option.nbre_choix == null || familleOption.famille_option.nbre_choix == 0) && (familleOption.famille_option.type == "multiple")){
					 var variationsubTitle = $('<p>' + "Choisissez-en " + familleOption.options.length +  " max." + '<p>');
  
				 variationsubTitle.appendTo(variationWrapper);
				}
				if(familleOption.famille_option.type == "simple" ){
					 var variationsubTitle = $('<p>' + "Choisissez-en 1 " + '<p>');
				 variationsubTitle.appendTo(variationWrapper);
				
				}
              variationWrapper.appendTo(variationElement);

var selectedOptionsnonSupplementaires = [];
var selectedOptionsSupplementaires = [];

// Check if productOptions is defined and not empty
if (productOptions !== undefined && productOptions.trim() !== '') {
  // Split the 'productOptions' into an array
  var optionsArray = productOptions.split('SUPPLÉMENTAIRES');

  // Separate the options into two variables
  var nonSupplementairesArray = optionsArray[0].trim();
	
  selectedOptionsnonSupplementaires = nonSupplementairesArray.split(',').map(function(option) {
    return option.trim(); // Remove leading/trailing spaces
  });
 if (optionsArray.length > 1) {
  var supplementairesArray = optionsArray[1].trim();
	  selectedOptionsSupplementaires = supplementairesArray.split(',').map(function(option) {
    return option.trim(); // Remove leading/trailing spaces
  });
}
	 }
 
				
				
				
				for (var j = 0; j < options.length; j++) {
				  
                let option = options[j]; // Use let instead of var to correctly scope the variable
 
                var variationItem = $('<div class="customize-variation-item" data-price="' + option.prix + '"></div>');
                var variationIcon = $('<i class="flaticon-bread-roll"></i>');
            
             
				    var customControl = $('<div class="custom-control custom-' + (familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox') + ' ' + generateUniqueClassName() + '"></div>');
            
                function generateUniqueClassName() {
  
  var uniqueId = new Date().getTime(); // Using a timestamp as a unique identifier
  return 'unique-' + uniqueId;
}
                var inputType = familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox';

 
				  // Check if an option should be pre-selected
			
  var shouldBeCheckedSupp = selectedOptionsSupplementaires.includes(option.nom_option);
var shouldBeCheckedNSupp = selectedOptionsnonSupplementaires.includes(option.nom_option);


               if (familleOption.famille_option.type === 'qte') {
  inputType = 'number';
  input = $('<input type="' + inputType + '" id="' + option.id + '" name="quantity" min="0" class="custom-control-input">');
  input.css('width', '50px');
  // For "qte" type options, attach an event handler to update the quantity
  input.on('input', function() {
    var optionId = $(this).attr('id');
    var quantity = parseInt($(this).val(), 10) || 1; // Ensure a valid integer (default to 1 if invalid)
    
    // Update the quantity in the selectedOptions object using optionId
    if (selectedOptions.hasOwnProperty(optionId)) {
      selectedOptions[optionId].Quantity = quantity;
    }
  });
} else if (inputType === 'radio') {
  if (productIdEdit !== undefined) {
    input = $('<input type="radio" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input">');
    if (!isNaN(option.prix) && option.prix !== null) {
      if (shouldBeCheckedSupp) {
        input.prop('checked', true);
      }
    } else {
      if (shouldBeCheckedNSupp) {
        input.prop('checked', true);
      }
    }
  }
} else if (inputType === 'checkbox') {
  if (productIdEdit !== undefined) {
    input = $('<input type="checkbox" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input">');
    if (!isNaN(option.prix) && option.prix !== null) {
      if (shouldBeCheckedSupp) {
        input.prop('checked', true);
      }
    } else {
      if (shouldBeCheckedNSupp) {
        input.prop('checked', true);
      }
    }

    // Add an event listener to the checkbox
    input.on('change', function() {
      createCheckboxChangeHandler(familleOption);
    });
  }
}
 

		 
		 
		 
  var label = $('<label class="custom-control-label" for="' + option.id + '"> ' + option.nom_option + ' </label>');
  if(option.prix != null){
                var price = $('<span> +' + option.prix + '€ </span>');
  }else {
    var price = $('');
  }
input.appendTo(customControl).css('margin-right', '7px');
                label.appendTo(customControl);
                customControl.appendTo(variationItem);
                price.appendTo(variationItem);
                variationIcon.appendTo(variationWrapper);
                variationItem.appendTo(variationWrapper);


              }
  
              variationElement.appendTo(row);
            }
			  var totalquantityInput = $('#totalquantity');
    totalquantityInput.val(productquantity);
            var customizeControls = $('.customize-controls');
       
           var quantityLabel = $('.qty');
//var quantityLabel = $('<div class="qty"></div>');
var subtractButton = $('.qty-subtract');
//var quantityInput = $('<input type="number" name="totalquantity"  id="totalquantity" value="1">');
var addButton  = $('.qty-add');





var priceLabel = $('.customize-total');
    $('.final-price.custom-primary').text( productprix + '€' );
          

addButton.off('click');
subtractButton.off('click');

//action
addButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity)) {
    totalquantityInput.val(currentQuantity + 1);
    updateTotalPrice(); 
  }
});
subtractButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity) && (currentQuantity > 1)) {
    totalquantityInput.val(currentQuantity - 1);
    updateTotalPrice(); 
  }
});

$('.modal-body .order-item.btn-custom.btn-sm.shadow-none.customizeBtn').remove();
		
if (productIdAdd !== undefined) {
var addToCartBtn = $('<button type="submit"  class="order-item btn-custom btn-sm shadow-none customizeBtn" data-product-id="' + productId + '" data-product-name="' + response.product.nom_produit + '" data-product-image="' + response.product.url_image + '" data-product-price="' + response.product.prix + '">Ajouter au Panier <i class="fas fa-shopping-cart"></i></button>');
}else {

var addToCartBtn = $('<button type="submit"  class="order-item btn-custom btn-sm shadow-none customizeBtn" data-product-id-edit="' + productId + '" data-product-name="' + response.product.nom_produit + '" data-product-image="' + response.product.url_image + '" data-product-item="' + productitem + '" data-product-price="' + response.product.prix + '">Mettre à jour <i class="fas fa-shopping-cart"></i></button>');
}
addToCartBtn.appendTo('.modal-body');
	
			  // Create the "Cancel" button
			  $('.modal-body .btn.btn-sm.shadow-none.cancelButton').remove();
var cancelButton = $('<button type="button" class="btn btn-sm shadow-none cancelButton" data-dismiss="modal">Annuler</button>');

// Append both buttons to the modal body
$('.modal-body').append(addToCartBtn, cancelButton);
cancelButton.on('click', function() {
 
// Close the modal when the button is clicked
$('#customizeModal').modal('hide');
});
        // Calculate and update the total price
            updateTotalPrice();
           
            // Show the modal
            $('#customizeModal').on('shown.bs.modal', function() {
				 $('.customize-variation-wrapper input[type="radio"]:checked').each(function() {
    // Trigger the 'change' event for each initially checked radio button
    $(this).trigger('change');
  });
   
	 $('.final-price.custom-primary').text(productprix);
  });
			  
            $('#customizeModal').modal('show');
          },
          error: function(err) {
            console.log(err);
          }
        });
		  
      });
		 
     selectedOptions = [];
		 
  selectedOptionsproduits = [];
         $(document).on('change', '.customize-variation-wrapper input[type="checkbox"], .customize-variation-wrapper input[type="radio"], .customize-variation-wrapper input[type="number"], .customize-variations #totalquantity', function() {
  // Clear the selectedOptions array to start fresh
  selectedOptionsproduits = [];
// Loop through the selected options to store their details
$('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
        var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat($(this).closest('.customize-variation-item').data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = 1;

        selectedOptionsproduits.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			Quantity: optionQuantity,
        });
      
    });
    
    $('.customize-variation-wrapper input[name="quantity"]').each(function() {

     
      var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());

  if(quantity >= 1){
      var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat(optionItem.data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = quantity;

  // Push the selected option's details into the selectedOptions array
        
  selectedOptionsproduits.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			      Quantity: optionQuantity,
        });
  }
    });
   
   
 // Handle quantity input if present
 var totalQuantity = parseInt($('#totalquantity').val());
    if (isNaN(totalQuantity) || totalQuantity < 1) {
        totalQuantity = 1;
    }
          // Calculate and update the total price
  updateTotalPrice();
 
      });
  
    
function createCheckboxChangeHandler(familleOption) {
   return function() {
        // Get all checkboxes in this specific familleOption group
        var checkboxes = $('input[name="' + familleOption.id + '"]');
        
        // Get the number of checkboxes selected in this group
        var selectedCount = checkboxes.filter(':checked').length;
        if (familleOption.famille_option.nbre_choix != null && familleOption.famille_option.nbre_choix != 0)
        // Check if the selectedCount exceeds the maximum allowed for this group
		{ if (selectedCount >= familleOption.famille_option.nbre_choix) {
            // Uncheck and disable checkboxes if the limit is exceeded
            checkboxes.filter(':not(:checked)').prop('disabled', true);
        } else {
            // Enable all checkboxes within the group if the limit is not exceeded
            checkboxes.prop('disabled', false);
        }}
    };
}

      // Function to calculate and update the total price
      function updateTotalPrice() {
        var totalPrice = parseFloat(response.product.prix);
        console.log('Total Price:', totalPrice);

        // Loop through the selected options
        $('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
         
          var optionPrice = $(this).closest('.customize-variation-item').data('price');
              console.log('optionPrice:', optionPrice);
         
              if (optionPrice != null) {
    
    optionPrice = parseFloat(optionPrice);
   
}else{
  optionPrice = 0;
}
          totalPrice += optionPrice;
        });
  
     // Handle quantity for options
var optionQuantity = 0;
var optionQuantityPrice = 0;

$('.customize-variation-wrapper input[name="quantity"]').each(function() {
  var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());
  if (isNaN(quantity) || quantity < 1) {
    quantity = 0;
  }


  //optionQuantity += quantity;
  if (!isNaN(optionPrice)) 
         {
  optionQuantityPrice += optionPrice * quantity;
  }
 
  console.log('Option Quantity:', quantity);
});
totalPrice += optionQuantityPrice;


console.log('Option Quantity Price:', optionQuantityPrice);

  // Handle quantity for total price
  var totalPriceQuantity ;
  var totalPriceQuantityInput = $('#totalquantity');
  if (totalPriceQuantityInput.length > 0) {
    totalPriceQuantity = parseInt(totalPriceQuantityInput.val());
    if (isNaN(totalPriceQuantity) || totalPriceQuantity < 1) {
      totalPriceQuantity = 1;
    }
  }


 

  // Update the total price based on the quantities
  totalPrice *= totalPriceQuantity;

  //var addToCartBtn = $('.order-item');
   // addToCartBtn.attr('data-product-price', totalPrice);
        // Update the total price display
        $('.total-price').html(totalPrice + '€');
       
        var priceTotal = $('.final-price.custom-primary');
        priceTotal.text(totalPrice.toFixed(2) + '€');
      
      }

      $('.close-btn').on('click', function() {
    $('#customizeModal').modal('hide');

  });
   $('#customizeModal').on('hidden.bs.modal', function () {
    // Set the text of the element with class 'final-price.custom-primary' to an empty string
    $('.final-price.custom-primary').text("");
  });
/*  function initializeTotalQuantity() {
    var totalquantityInput = $('#totalquantity');
    totalquantityInput.val(productquantity);
  }*/

 });
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
$(document).ready(function() {
 let nextId = 1;
  // Existing code...
  $(document).on('click', '.order-item.btn-custom.btn-sm.shadow-none.customizeBtn', function() {
  console.log("Button clicked!");
	   var productIdAdd = $(this).data('product-id');
    var productIdEdit = $(this).data('product-id-edit');
	 
    var productIditem = $(this).data('product-item');
  if (productIdEdit !== undefined) {
     var productId = productIdEdit; 
    } else {
     var productId = productIdAdd; 
    }
  // Retrieve the selected customization options, product ID, name, and price
  var priceTotal = $('.final-price.custom-primary');
 // var productId = response.product.id; 
  var productName = response.product.nom_produit;
  var productImage = response.product.url_image;
  var productPrice =  parseFloat(priceTotal.text().replace('€', ''));
  var productUnityPrice = response.product.prix;
  var productQuantity = $('#totalquantity').val();
  var customizationOptions = getSelectedOptions(); // Implement the logic to retrieve the selected options
  
  // Construct the cart item data to send to the server
 
if (productIdEdit !== undefined) {
	 var cartItem = {
	
    id: productId,
	idItem: productIditem,
    name: productName,
    image: productImage,
    price: productPrice,
    unityPrice: productUnityPrice,
    quantity: productQuantity,
    options: customizationOptions };
	
      editCart(cartItem);
		selectedOptionsproduits = [];
    } else {
		function generateUUID() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = (Math.random() * 16) | 0,
      v = c === 'x' ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}

var productIditem = generateUUID();
		
		 var cartItem = {
    id: productId,
	idItem: productIditem,
    name: productName,
    image: productImage,
    price: productPrice,
    unityPrice: productUnityPrice,
    quantity: productQuantity,
    options: customizationOptions
  };
		
     addToCart(cartItem);
			selectedOptionsproduits = [];
    }
    // Send a POST request to add the item to the cart
   // addToCart(cartItem);
    selectedOptions = [];
      // After adding the item, update the cart sidebar and cart item count in the header
     // updateCartSidebar();
  });


  function addToCart(cartItem) {
    $.ajax({
      url: '{{ route("cart.add", ["subdomain" => $subdomain]) }}',
      method: 'POST',
      data: {
        cartItem: cartItem,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        // Update the cart sidebar with the updated cart data
        updateCartSidebar();
        // Show a success message or update the cart icon, etc.
     
        //alert('Product added to cart successfully'); // You can use your preferred success message here
      $('#customizeModal').modal('hide'); // Close the customize modal
 toastr.success('Votre commande est ajoutée avec succès');
		 
      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error adding product to cart:', error);
		  
        // Show an error message or handle the error gracefully
      }
	
    });
	 
  }
function editCart(cartItem) {
	console.log(cartItem);

    $.ajax({
      url: '{{ route("cart.edit", ["subdomain" => $subdomain]) }}',
      method: 'POST',
      data: {
        cartItem: cartItem,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        // Update the cart sidebar with the updated cart data
        updateCartSidebar();
        // Show a success message or update the cart icon, etc.
     
        //alert('Product added to cart successfully'); // You can use your preferred success message here
      $('#customizeModal').modal('hide'); // Close the customize modal
 toastr.success('Votre commande est modifieé avec succès');
      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error editing product :', error);
        // Show an error message or handle the error gracefully
      }
    });
  }

function getSelectedOptions() {
  var optionsWithPrice = '';
  var optionsWithoutPrice = '';

  selectedOptionsproduits.forEach(function(option) {
    var optionName = option.name;
    var optionPrice = option.price;
    var optionType = option.type;
    var optionQuantity = option.Quantity;

    if (!isNaN(optionPrice)) {
      if (optionType === 'number') {
        optionsWithPrice += optionQuantity + '×' + optionName + '(' + optionPrice + '€), ';
      } else {
        optionsWithPrice += optionName + '(' + optionPrice + '€), ';
      }
    } else {
      if (optionType === 'number') {
        optionsWithoutPrice += optionQuantity + '×' + optionName + ', ';
      } else {
        optionsWithoutPrice += optionName + ', ';
      }
    }
  });

  // Convert "supplémentaires" to uppercase
  var uppercaseSupplementaires = 'SUPPLÉMENTAIRES';

  // Combine the options
  var designation = optionsWithoutPrice.trim();
  if (designation !== '' && optionsWithPrice !== '') {
    designation += '\n' + uppercaseSupplementaires + '\n' + optionsWithPrice.trim();
  } else {
    designation += optionsWithPrice.trim();
  }
selectedOptionsproduits = [];
  return designation;
}


});
function updateCartSidebar() {

  $('body').addClass('disable-interaction');
    // Make an AJAX request to fetch the updated cart data
    $.ajax({
      url: '{{ route("cart.fetch", ["subdomain" => $subdomain]) }}',
      method: 'GET',
      success: function(response) {
        $('body').removeClass('disable-interaction');
        console.log(response);
        



      // Update the cart sidebar with the updated cart items
    var cartSidebarScroll = $('.cart-sidebar-scroll');
    cartSidebarScroll.empty(); // Clear existing content
console.log(response.cartItems);
    // Loop through the cart items and add them to the sidebar
    $.each(response.cartItems, function(index, cartItem) {
    var itemHTML = '<div class="cart-sidebar-item">';
    itemHTML += '<div class="media">';
    itemHTML += '<a ><img src="' + cartItem.image + '" alt="product"></a>';
    itemHTML += '<div class="media-body">';
    itemHTML += '<h5><a href="menu-item-v1.html" title="' + cartItem.name + '">' + cartItem.name + '</a></h5>';
    itemHTML += '<span>' + cartItem.quantity + 'x ' + cartItem.unityPrice + '€</span>';
    itemHTML += '</div></div>';
    itemHTML += '<div class="cart-sidebar-item-meta">';
    
    // Check if cartItem.options is a non-empty string
    if (typeof cartItem.options === 'string' && cartItem.options.trim() !== '') {
        itemHTML += '<span>' + cartItem.options + '</span>';
    }
    
    itemHTML += '</div>';
    itemHTML += '<div class="cart-sidebar-price">';
    itemHTML += cartItem.price + '€';
    itemHTML += '</div>';
   itemHTML += '<div class="customizeBtnedit" data-bs-toggle="modal" data-bs-target="#customizeModal" ' +
    'data-product-id-edit="' + cartItem.id + '" ' +
	   'data-product-name="' + cartItem.name + '" ' +
    'data-product-image="' + cartItem.image + '" ' +
    'data-product-unityprice="' + cartItem.unityPrice + '" ' +
	   'data-product-price="' + cartItem.price + '" ' +
	   'data-product-qauntity="' + cartItem.quantity + '" ' +
	    'data-product-item="' + cartItem.idItem + '" ' +
	   
    'data-product-options=\'' + JSON.stringify(cartItem.options) + '\'>';

// Add the button icon
itemHTML += '<i class="fas fa-edit"></i>';

// Close the customizeBtn div element
itemHTML += '</div>';
  itemHTML += '<div class="remove-btn" data-item-id="' + cartItem.id + '">';
  itemHTML +=  '<i class="fas fa-times"></i>';
  itemHTML += '<span></span>';
	  
	  
	  
	
	
	   
  itemHTML += '</div></div>';

    cartSidebarScroll.append(itemHTML);
});
     // Update the cart item count in the header
     var cartItemCount = $('.cart-item-count');
    cartItemCount.text(response.cartItemCount);

    var totalPriceElement = $('.cart-sidebar-footer span');
totalPriceElement.text(response.totalPrice + '€');
        // Show the cart sidebar
        $('#cartSidebarWrapper&').addClass('active');
      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error fetching cart data:', error);
        $('body').removeClass('disable-interaction');
        // Show an error message or handle the error gracefully
      }
    });
  } 
  </script>
  <!-- Newsletter End -->
  @include('client.layouts.footer_client')