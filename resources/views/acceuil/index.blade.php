<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>HelloData</title>
  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assetsAcceuil/css/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('assetsAcceuil/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assetsAcceuil/css/responsive.css')}}" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <img src="{{ asset('assetsAcceuil/images/logo.png')}}" alt="" />
            <span>
              HelloData
            </span>
          </a>

          <div class="navbar-collapse" id="">
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="index.html">HOME</a>
                <a href="about.html">ABOUT</a>
                <a href="food.html">Food</a>
                <a href="contact.html">Contact Us</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div class="side_heading">
        <h5>
          H
          e
          l
          l
          o
          D
          a
          t
          a
        </h5>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-4 offset-md-1">
            <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="img-box b-1">
                    <img src="{{ asset('assetsAcceuil/images/4.png')}}" alt="" />
                  </div>
                </div>
                {{-- <div class="carousel-item">
                  <div class="img-box b-2">
                    <img src="{{ asset('assetsAcceuil/images/1.png')}}" alt="" />
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box b-3">
                    <img src="{{ asset('assetsAcceuil/images/2.png')}}" alt="" />
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box b-4">
                    <img src="{{ asset('assetsAcceuil/images/3.png')}}" alt="" />
                  </div>
                </div> --}}
              </div>
              <div class="carousel_btn-box">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class=" col-md-5 offset-md-1">
            <div class="detail-box">
              <h1>
                HelloData <br>
                System
              </h1>
              <p>
                
              Our system facilitates the relationship between customer and sellers .
              Our Product management system, category, customer, orders with your unique domain .
              </p>

              <div class="btn-box">
                <a href="" class="btn-1" style="width: 40%">
                  Contact Us
                </a>
               
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->
  <section class="about_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 offset-md-1">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <br>
                Our <br>
                Food
              </h2>
              <hr>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in
              some form, by injected humour, or randomised words
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src="{{ asset('assetsAcceuil/images/about-img.jpg')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- dish section -->

  <section class="dish_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="dish_container">
            <div class="box">
              <img src="{{ asset('assetsAcceuil/images/dish.jpg')}}" alt="">
            </div>
            <div class="box">
              <img src="{{ asset('assetsAcceuil/images/dish.jpg')}}" alt="">
            </div>
            <div class="box">
              <img src="{{ asset('assetsAcceuil/images/dish.jpg')}}" alt="">
            </div>
            <div class="box">
              <img src="{{ asset('assetsAcceuil/images/dish.jpg')}}" alt="">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <hr>
              <h2>
                Our <br>
                Food <br>
                dishs
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in
              some form, by injected humour, or randomised words
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end dish section -->

  <!-- hot section -->

  <section class="hot_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          What's Hot
        </h2>
        <hr>
      </div>
      <p>
        There are many variations of passages of Lorem Ipsum available, but the majority
      </p>
    </div>
    <div class="carousel_container">
      <div class="container">
        <div class="carousel-wrap ">
          <div class="owl-carousel">
            <div class="item">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('assetsAcceuil/images/hot-1.png')}}" />
                </div>
                <div class="detail-box">
                  <h4>
                    $30
                  </h4>
                  <p>
                    There are many variations of passages of Lorem Ipsum available,
                  </p>
                  <a href="">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('assetsAcceuil/images/hot-2.png')}}" />
                </div>
                <div class="detail-box">
                  <h4>
                    $30
                  </h4>
                  <p>
                    There are many variations of passages of Lorem Ipsum available,
                  </p>
                  <a href="">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="box">
                <div class="img-box">
                  <img src="{{ asset('assetsAcceuil/images/hot-3.png')}}" />
                </div>
                <div class="detail-box">
                  <h4>
                    $30
                  </h4>
                  <p>
                    There are many variations of passages of Lorem Ipsum available,
                  </p>
                  <a href="">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end hot section -->

  <!-- app section -->

  <section class="app_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="img-box">
            <img src="{{ asset('assetsAcceuil/images/man-with-phone.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-6 offset-md-2">
          <div class="detail-box">
            <h2>
              <span> 50% </span> off On every food
              download now our app
            </h2>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
              in
              some form, by
            </p>
            <div class="btn-box">
              <a href="">
                <img src="{{ asset('assetsAcceuil/images/app-store.png')}}" alt="">
              </a>
              <a href="">
                <img src="{{ asset('assetsAcceuil/images/play-store.png')}}" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end app section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      

    </div>
  </section>
  <!-- end client section -->

  <!-- contact section -->

  <section class="contact_section layout_padding-bottom ">
    <div class="container">
      <h2>
        Get In touch
      </h2>
      <div class="row">
        <div class="col-md-7">
          <div class="form_container">
            <form action="">
              <input type="text" placeholder="Name">
              <input type="text" placeholder="Phone number">
              <input type="email" placeholder="Email">
              <input type="text" placeholder="Message" class="message_input">
              <button>
                Send
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-5">
          <div class="contact_box">
            <a href="">
              <div class="img-box">
                <img src="{{ asset('assetsAcceuil/images/location.png')}}" alt="">
              </div>
              <h6>
                tunis , tunis
              </h6>
            </a>
            <a href="">
              <div class="img-box">
                <img src="{{ asset('assetsAcceuil/images/call.png')}}" alt="">
              </div>
              <h6>
                (+216) 53551146
              </h6>
            </a>
            <a href="">
              <div class="img-box">
                <img src="{{ asset('assetsAcceuil/images/envelope.png')}}" alt="">
              </div>
              <h6>
                support@hellodata.com
              </h6>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

 
  <!-- end subscribe section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <div class="social_container">
      <h4>
        Follow on
      </h4>
      <div class="social-box">
        <a href="">
          <img src="{{ asset('assetsAcceuil/images/fb.png')}}" alt="">
        </a>
        <a href="">
          <img src="{{ asset('assetsAcceuil/images/twitter.png')}}" alt="">
        </a>
        <a href="">
          <img src="{{ asset('assetsAcceuil/images/linkedin.png')}}" alt="">
        </a>
        <a href="">
          <img src="{{ asset('assetsAcceuil/images/youtube.png')}}" alt="">
        </a>
      </div>
    </div>
    <p>
      &copy; 2023 All Rights Reserved @HelloData.
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="{{ asset('assetsAcceuil/js/jquery-3.4.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assetsAcceuil/js/bootstrap.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>

  <!-- owl carousel script -->
  <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 35,
      navText: [],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    });
  </script>
  <!-- end owl carousel script -->

</body>

</html>