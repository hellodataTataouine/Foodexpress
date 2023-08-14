
  <!-- Footer Start -->
  <footer class="ct-footer footer-dark">
    <!-- Top Footer -->
    <div class="container">
      <div class="footer-top">
        <div class="footer-logo">
          <img src="{{ asset($client->logo) }}" style="max-width:135px;max-height:73px;" alt="logo">
        </div>
        
      </div>
    </div>

    <!-- Middle Footer -->
    <div class="footer-middle">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 footer-widget">
            <h5 class="widget-title">Information</h5>
            <ul>
              <li> <a href="index.html">Home</a> </li>
              <li> <a href="blog-grid.html">Blog</a> </li>
              <li> <a href="about-us.html">About Us</a> </li>
              <li> <a href="menu-v1.html">Menu</a> </li>
              <li> <a href="contact-us.html">Contact Us</a> </li>
            </ul>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 footer-widget">
           
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 footer-widget">
            
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 footer-widget">
            <h5 class="widget-title">Social Media</h5>
            <ul class="social-media">
              <li> <a href="#" class="facebook"> <i class="fab fa-facebook-f"></i> </a> </li>
              <li> <a href="#" class="pinterest"> <i class="fab fa-pinterest-p"></i> </a> </li>
              <li> <a href="#" class="google"> <i class="fab fa-google"></i> </a> </li>
              <li> <a href="#" class="twitter"> <i class="fab fa-twitter"></i> </a> </li>
            </ul>
            <div class="footer-offer">
              <p>Signup and get exclusive offers and coupon codes</p>
              <a href="register.html" class="btn-custom btn-sm shadow-none">Sign Up</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container">
        <ul>
         
        </ul>
        <div class="footer-copyright">
          <p> Copyright &copy; 2023 <a href="#">hello Data</a> All Rights Reserved. </p>
          <a href="#" class="back-to-top">Back to top <i class="fas fa-chevron-up"></i> </a>
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
