<style>
	
	.footer-curve {
    height: 120px;
}
.footer-curve .section-curve-wrapper {
    width: calc(100% + 800px);
    left: 0;
    background-repeat: repeat-x;
    -webkit-animation: 25s curve_wave infinite linear;
    animation: 25s curve_wave infinite linear;
}
	@-webkit-keyframes curve_wave {
    0% {
        left: 0;
    }
    100% {
        left: -750px;
    }
}
@keyframes curve_wave {
    0% {
        left: 0;
    }
    100% {
        left: -750px;
    }
}
	
	
.h-100 {
    height: 100% !important;
}
.top-0 {
    top: 0 !important;
}
.position-absolute {
    position: absolute !important;
}
*, *::before, *::after {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
	
	.gshop-footer .tomato {
    left: 60px;
    top: 50px;
    -webkit-animation: 6s upsdown_animation infinite;
    animation: 6s upsdown_animation infinite;
}
.gshop-footer .pata-lg {
    left: 150px;
    top: 180px;
    -webkit-animation: 6s moving-x-animation infinite;
    animation: 6s moving-x-animation infinite;
}
.gshop-footer .pata-xs {
    left: 50px;
    top: 300px;
    -webkit-animation: 5s upsdown_animation linear infinite;
    animation: 5s upsdown_animation linear infinite;
}
.gshop-footer .frame-circle {
    left: 130px;
    top: 50%;
    -webkit-animation: 6s upsdown_animation infinite;
    animation: 6s upsdown_animation infinite;
}
.gshop-footer .leaf {
    bottom: 40px;
    left: 30px;
    -webkit-animation: 8s rotate_animation infinite linear;
    animation: 8s rotate_animation infinite linear;
}
.gshop-footer .leaf-2 {
    right: 100px;
    top: 130px;
    -webkit-animation: 12s rotate_animation infinite linear;
    animation: 12s rotate_animation infinite linear;
}
.gshop-footer .pata-xs-2 {
    right: 50px;
    top: 230px;
    -webkit-animation: 6s upsdown_animation linear infinite;
    animation: 6s upsdown_animation linear infinite;
}
.gshop-footer .tomato-slice {
    right: 200px;
    top: 50%;
    -webkit-animation: 6s upsdown_animation linear infinite;
    animation: 6s upsdown_animation linear infinite;
}
.gshop-footer .tomato-half {
    bottom: 80px;
    right: 110px;
    -webkit-animation: 6s moving-x-animation linear infinite;
    animation: 6s moving-x-animation linear infinite;
}
@media (max-width: 1800px) {
    .gshop-footer .frame-circle {
        left: 30px;
    }
    .gshop-footer .tomato-slice {
        right: 30px;
    }
}
@media (max-width: 1600px) {
    .gshop-footer .frame-circle {
        display: none;
    }
}
@media (max-width: 575.98px) {
    .gshop-footer .vector-shape {
        display: none;
    }
}
@media (max-width: 767.98px) {
    .gshop-footer {
        padding-bottom: 60px;
    }
}
 @keyframes upsdown_animation {
    0% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
    25% {
        -webkit-transform: translateY(-25px);
        transform: translateY(-25px);
    }
    50% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
    75% {
        -webkit-transform: translateY(25px);
        transform: translateY(25px);
    }
    100% {
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
}
	@keyframes shaking_animation {
    0% {
        -webkit-transform: translate(0, 0) rotate(0deg);
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        -webkit-transform: translate(5px, 5px) rotate(5deg);
        transform: translate(5px, 5px) rotate(5deg);
    }
    50% {
        -webkit-transform: translate(0, 0) rotate(0eg);
        transform: translate(0, 0) rotate(0eg);
    }
    75% {
        -webkit-transform: translate(-5px, 5px) rotate(-5deg);
        transform: translate(-5px, 5px) rotate(-5deg);
    }
    100% {
        -webkit-transform: translate(0, 0) rotate(0deg);
        transform: translate(0, 0) rotate(0deg);
    }
}
	@keyframes moving-x-animation {
    0% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
    25% {
        -webkit-transform: translateX(30px);
        transform: translateX(30px);
    }
    50% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
    75% {
        -webkit-transform: translateX(-30px);
        transform: translateX(-30px);
    }
    100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
}
@keyframes rotate_animation {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}	
</style>


<div class="footer-curve position-relative overflow-hidden">
    <span class="position-absolute section-curve-wrapper top-0 h-100"
        data-background="https://saladetcie.foodexpress.site/uploads//section-curve.png?v=v2.7.0"  style="background-image: url(&quot;https://saladetcie.foodexpress.site/uploads//section-curve.png?v=v2.7.0&quot;);"></span>
</div>
  <!-- Footer Start -->


   

<footer class="ct-footer footer-dark position-relative pt-8  z-1 overflow-hidden gshop-footer">
	 <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/tomato.svg?v=v2.7.0" alt="tomato"
        class="position-absolute z--1 tomato vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/pata-lg.svg?v=v2.7.0" alt="pata"
        class="position-absolute z--1 pata-lg vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/pata-xs.svg?v=v2.7.0" alt="pata"
        class="position-absolute z--1 pata-xs vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/frame-circle.svg?v=v2.7.0" alt="frame"
        class="position-absolute z--1 frame-circle vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/leaf.svg?v=v2.7.0" alt="leaf"
        class="position-absolute z--1 leaf vector-shape">
    <!--shape right -->
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/leaf.svg?v=v2.7.0" alt="pata"
        class="position-absolute leaf-2 z--1 vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/pata-xs.svg?v=v2.7.0" alt="pata"
        class="position-absolute pata-xs-2 z--1 vector-shape">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/tomato-slice.svg?v=v2.7.0" alt="tomato slice"
        class="position-absolute tomato-slice vector-shape z--1">
    <img src="https://grostore.themetags.com/public/frontend/default/assets/img/shapes/tomato-half.svg?v=v2.7.0" alt="tomato"
        class="position-absolute tomato-half z--1 vector-shape">
    <!-- Top Footer -->
    <div class="container">
		
		
		   <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6">
                <div class="gshop_subscribe_form text-center">
               
                </div>
            </div>
        </div>
		
		
      <div class="footer-top">
        <div class="footer-logo">
         </div>
        
      </div>
    </div>

    <!-- Middle Footer -->
    <div class="footer-middle">
      <div class="container">
        <div class="row g-5">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
			    <div class="footer-widget">
          <h5 class="text-white mb-4">Informations</h5>
                <ul class="footer-nav">
             
              <li> <a href="/mentions-legales">Mentions légales</a> </li>
              <li> <a href="/politique-de-cookies">Politique de cookies</a> </li>
             
			  </ul>
          </div>
			  </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 footer-widget">
			   <div class="footer-widget">
            <h5 class="text-white mb-4">Liens rapides</h5>
			   <ul class="footer-nav">
			   <li> <a href="/store">Accueil</a> </li>
			  <li> <a href="/contact">Contact</a> </li>
				   </ul>
          </div>
			    </div>
        
          <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 footer-widget">
            <h5 class="widget-title">Réseaux sociaux</h5>
            <ul class="social-media">
              <li> <a href="" class="facebook"> <i class="fab fa-facebook-f"></i> </a> </li>
              <li> <a href="" class="pinterest"> <i class="fab fa-pinterest-p"></i> </a> </li>
              <li> <a href="" class="google"> <i class="fab fa-google"></i> </a> </li>
              <li> <a href="" class="twitter"> <i class="fab fa-twitter"></i> </a> </li>
            </ul>
           
          </div>
        </div>
      </div>
    </div> -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container">
        <ul>
         
        </ul>
        <div class="footer-copyright">
          <p> Copyright &copy; 2023 <a href="#">hello Data</a> Tous droits réservés. </p>
          <a href="#" class="back-to-top">Haut <i class="fas fa-chevron-up"></i> </a>
        </div>
      </div>
    </div>

  </footer>
  <!-- Vendor Scripts -->
  <script>
  if(document.getElementById("logout-link")){
    document.getElementById("logout-link").addEventListener("click", function(e) {
      e.preventDefault(); // Prevent the default behavior of the anchor tag
      document.getElementById("logout-forum").submit(); // Submit the form
    });
  }
  </script>
  <script src="{{ asset('assetsClients/js/plugins/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/waypoint.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/jquery.slimScroll.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/imagesloaded.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assetsClients/js/plugins/slick.min.js') }}"></script>
 <script src="{{ asset('assetsClients/js/plugins/jquery.slimScroll.min.js') }}"></script>

  <script src="{{ asset('assetsClients/js/main.js') }}"></script>
<script>

document.addEventListener("DOMContentLoaded", function() {
  // Show the popup
  if(document.querySelector(".popup-overlay")){
  document.querySelector(".popup-overlay").style.display = "block";
  document.querySelector(".popup-content").style.display = "block";
  }
  // Close the popup when the close button is clicked
  if(document.querySelector(".popup-close")){
  document.querySelector(".popup-close").addEventListener("click", function() {
    document.querySelector(".popup-overlay").style.display = "none";
    document.querySelector(".popup-content").style.display = "none";
  });
}
});

</script>
  <!-- Slices Scripts -->

</body>

</html>
