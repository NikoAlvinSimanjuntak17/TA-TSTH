
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','name-title')</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('admindasboard/assets/img/favicon/logopiza.png') }}" />

  <link href="{{asset('users/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('users/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/floating-wpp.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
  <script src="{{asset('users/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" href="{{asset('users/css/navbar.css')}}">
  <link href="{{asset('css/floating-wpp.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/floating-wpp.min.css')}}">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  @yield('csss')

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span> Senin-Minggu: 10.00 - 21.00</span></i>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

        <h1 class="logo me-auto me-lg-0"><a href="{{route('home')}}" class="logos">Pizza Andaliman</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home') : '#hero' }}">Beranda</a></li>
                <li><a class="nav-link scrollto" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home').'#events' : '#events' }}">Layanan</a></li>
                <li><a class="nav-link scrollto" href="{{ request()->routeIs('editprofil','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home').'#product' : '#product' }}">Produk</a></li>
                <li><a class="nav-link scrollto" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home').'#book-a-table' : '#book-a-table' }}">Reservasi</a></li>
                <li><a class="nav-link scrollto" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home').'#testimonials' : '#testimonials' }}">Feedback</a></li>
                <li>
                    <div class="dropdown">
                        <a class="nav-link scrollto dropdown-toggle" href="#" role="" id="navbarDropdown" data-bs-toggle="" aria-expanded="false">Lainnya</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home').'#gallery' : '#gallery' }}">Galeri</a></li>
                            <li><a class="dropdown-item" href="{{ request()->routeIs('editprofil','product','addtocart','singleproduct','placeorder', 'peddingreservations', 'peddingorders','userprofile','feedback','category','checkout','history','historidetil') ? route('home') .'#contact': '#contact' }}">Kontak</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

      @auth
      @if(auth()->user()->hasRole('customer'))
      <div class="d-flex p-1 me-3 nav-cart">
        <a href="{{ route('addtocart') }}" class="" style="position: relative;">
            <i class="bi bi-cart" style="font-size: 1.5rem;">
                <span id="cartCount" class="badge bg-danger">0</span>
            </i>
        </a>
    </div>
      @if (empty(Auth::user()->user_img))
      <img src="{{asset('users/img/profil.png')}}"  width="35px" height="35px" class="profil" onclick="toggleMenu()" alt="">
        @else
        <img src="{{asset(Auth::user()->user_img)}}"  width="35px" height="35px" class="profil rounded-circle" onclick="toggleMenu()" alt="">
      @endif
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
                        <div class="user-info">
                            @if (empty(Auth::user()->user_img))
                            <img src="{{asset('users/img/profil.png')}}" style="width: 50px; height:50px;" alt="">
                              @else
                              <img src="{{asset(Auth::user()->user_img)}}" style="width: 50px; height:50px;" alt="">
                            @endif
                            <br>
                            <h2>{{Auth::user()->name}}</h2>
                        </div><hr>
                        <a href="{{route('userprofile')}}" class="sub-menu-link">
                            <img src="{{asset('users/img/profil.png')}}" alt="">
                            <p class="ms-4">Profil</p>
                        </a>
                    <a href="{{route('peddingorders')}}" class="sub-menu-link">
                        <img src="{{asset('img/bag.png')}}" alt="">
                        <p class="ms-4">Pesanan</p>
                    </a>
                      <form method="POST" action="{{ route('logout') }}" class="sub-menu-link">
                            @csrf
                            <img src="{{asset('users/img/logout.png')}}" alt="">
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>

                        </form>
                    </div>
                  </div>
                  @elseif (auth()->user()->hasRole('admin'))
                  <a href="{{route('admindasboard')}}" class="btn btn-success">Halaman admin</a>
                  @endif
                  @endauth
                  @guest
                  <fieldset class="book-a-table-btn">
                    <a href="{{ route('login') }}" class="">Masuk / </a>
                    <a href="{{ route('register') }}" class="">Daftar</a>
                    </fieldset>
                    @endguest
    </>
  </header>
  <!-- End Header -->
@yield('main-content')




  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Informasi</h3>
              <p>
                Balige, Toba <br>
                Sumatera Utara, Indonesia<br><br>
                <strong>Phone:</strong> +6281260757573<br>
                <strong>Email:</strong> pizza_andaliman@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#events">Fasilitas</a></li>
            </ul>
          </div>



          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Kontak</h4>
            <p>Hubungi kontak resto yang tersedia jika anda mengalami suatu kendala </p>


          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Pizza Andaliman</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/restaurantly-restaurant-template/ -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/navbar.js')}}"></script>
  <script src="{{asset('users/js/navbar.js')}}"></script>
  <script src="{{asset('users/js/profil.js')}}"></script>
  <script src="{{asset('users/js/scroll.js')}}"></script>
  <script src="{{asset('users/js/jquery.min.js')}}"></script>
  <script src=""></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script src="{{asset('users/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('users/js/jquery.superslides.min.js')}}"></script>
  <script src="{{asset('users/js/custom.js')}}"></script>
  <script src="{{asset('users/js/bootstrap.bundle.min.js')}}"></script>

  <link rel="stylesheet" href="{{asset('users/js/jquery.min.js')}}">
  <script>
  function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
  }

  setTimeout(function() {
      document.getElementById('alert').style.display = 'none';
  }, 5000);

    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("cartcount") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cartCount').innerText = data.cartCount;
            });
    });

</script>


  <!-- Buat script wa -->
  <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="{{asset('css/floating-wpp.min.js')}}"></script>
  <script src="{{asset('css/floating-wpp.js')}}"></script>
  <script src="{{asset('users/js/whatsap.js')}}"></script>
  @stack('js')
</body>

</html>
