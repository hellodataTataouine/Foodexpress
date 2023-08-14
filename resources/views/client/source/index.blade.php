<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Restaurant Exemple</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assetsClient/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assetsClient/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link href="{{ asset('assetsClient/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsClient/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsClient/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsClient/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsClient/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('assetsClient/css/main.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('assetsClient/img/logo.png') }}" alt=""> -->
            <h1>HelloData<span>.</span></h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->
        <nav class="navbar">
        @auth
        <a class="btn-book-a-table" href="{{ url('client/panier') }}">Panier</a>
        <form action="{{ route('client.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-book-a-table">Déconnexion</button>
        </form>
        
        @else
        <a class="btn-book-a-table" href="{{ url('client/login') }}">Connexion</a>
        @endauth

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <main id="main">
    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Menu</h2>
          <p>Check Our <span>Menu</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
          @foreach($categories as $category)
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-{{ $category->id }}">
                  <h4>{{ $category->name }}</h4>
                </a>
              </li>
          @endforeach
        </ul>
        
        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Starters</h3>
            </div>

            <div class="row gy-5">
              @foreach($products as $product)
              <div class="col-lg-4 menu-item">
                <a href="{{ asset($product->url_image) }}" class="glightbox">
                  <img src="{{ asset($product->url_image) }}" class="menu-img img-fluid" alt="" style="height:300px;width:500px;">
                </a>
                <h4>{{ $product->nom_produit }}</h4>
                <p class="ingredients">
                  {{ $product->description }}
                </p>
                <p class="price">
                  {{ $product->prix }} DT
                </p>
                <a href="{{ route('panier.add', ['subdomain' => $subdomain, 'productId' => $product->id]) }}" class="btn-book-a-table">Add to Panier</a>

              </div><!-- Menu Item -->

              @endforeach
            </div>
          </div><!-- End Dinner Menu Content -->

        </div>

      </div>
    </section><!-- End Menu Section -->
    <!-- ======= Book A Table Section ======= -->
    <!-- ======= Contact Section ======= -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022 - US<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservations</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat: 11AM</strong> - 23PM<br>
              Sunday: Closed
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>HelloData</span></strong>. All Rights Reserved
      </div>
    </div>

  </footer>
 

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="{{ asset('assetsClient/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assetsClient/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('assetsClient/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('assetsClient/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('assetsClient/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('assetsClient/vendor/php-email-form/validate.js')}}"></script>

  <script src="{{ asset('assetsClient/js/main.js')}}"></script>

</body>

</html>