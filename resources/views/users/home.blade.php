@php
    $categories = App\Models\Category::latest()->get();
    $products = App\Models\ResearchData::orderBy('research_title', 'asc')->paginate(6); // Mengambil 6 produk per halaman

@endphp
@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Home')
@section('main-content')
<style>
    /* Ubah warna tombol pagination menjadi biru */
    .pagination li a {
        color: #ffffff !important;
    }
    .pagination li a {
        background-color: #cda45e !important;
    }

    .pagination li a:hover {
        background-color: #ffffff !important;
        color: #cda45e !important;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }

    /* Ubah warna ikon waktu */
    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
    .arrow{
        margin-left: 14.5em;
        font-size: 30px; /* Ubah ukuran ikon menjadi 24px */
        color: #cda45e;
        text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.5);
        font-weight: bolder;

    }
    .dropdown-menu {
    display: none !important;
    position: absolute;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-menu {
    display: block !important;
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<!-- Start slides -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container text-center" data-aos="zoom-in" data-aos-delay="100">
      <center>
        <div class="">
        <div class="">
          <h1>Welcome to <span>pizza andaliman</span></h1>
          <h2>Enjoy the best pizza in town!</h2>

          <div class="btns">
            <a href="#about" class="btn-menu animated fadeInUp scrollto">Tentang Resto</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto" >Booking Meja</a>
        </div>
        </div>

      </div>
      </center>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/img/IMG_7664.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Tentang resto pizza andaliman.</h3>
            <p class="fst-italic">
              Beberapa sejarah berdirinya pizza andaliman yang harus kamu ketahui.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Mulai berdiri pada tahun 2011 dan masih eksis hingga saat ini.</li>
              <li><i class="bi bi-check-circle"></i> Pemilik sekaligus founder dari resto ini bernama Bapak Sebastian Hutabrat bersama sang istri Ibu Imelda Napitupulu.</li>
              <li><i class="bi bi-check-circle"></i> Berawal dari restoran bernama “Boru Ku Resto” mula-mula dengan konsep nasgor, ikan, kopi, dan jus di lumban Silintong, daerah yang masih terbelakang dengan hanya 1-2 kafe saja dikala itu.</li>
            </ul>
            <p>
              Sempat berhenti dua bulan pada tahun 2011, suatu hari seorang warga negara asing dari Jerman yang tertarik untuk memperkenalkan pizza pada daerah ini dan melihat sambal andaliman buatan keluarga Ibu Imelda yang begitu unik.
              Kemudian, bersama orang Jerman tersebut, sang pemilik resto ini menggabungkan pizza dengan sambal andaliman. Hanya dengan sebuah oven kecil dan bahan dari pasar, mereka berhasil membangun restoran yang diberi nama "Pizza Andaliman". Perjalanan ini menkolaborasikan antara budaya lokal dan internasional, membawa kesuksesan kepada restoran yang unik ini.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Alasan</h2>
          <p>Kenapa pilih resto kita?</p>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <span>01</span>
              <h4>Online Order</h4>
              <p>Anda dapat melakukan orderan makanan dan reservasi secara online</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <span>02</span>
              <h4>Unik & Enak</h4>
              <p>Restoran yang menghadirkan cita rasa yang baru melalui pizza autentiknya</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300">
              <span>03</span>
              <h4>Pelayanan super</h4>
              <p>Menghadirkan pelayanan selayaknya restoran bintang 5 yang super</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->


    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Fasilitas</h2>
          <p>Beberapa Layanan yang Tersedia</p>
        </div>

        <div class="events-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="row event-item">
                <div class="col-lg-6">
                  <img src="assets/img/IMG_7639.jpg" class="img-fluid" alt="" />
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Toko Souvenir</h3>
                  <div class="price">
                    <p><span>Aksesoris</span></p>
                  </div>
                  <p class="fst-italic">Terdapat aksesoris yang mempunyai ciri khas toba seperti :</p>
                  <ul>
                    <li><i class="bi bi-check-circled"></i> Berbagai jenis gelang tradisional buatan tangan.</li>
                    <li><i class="bi bi-check-circled"></i> Berbagai jenis kaos yang unik dan keren.</li>
                    <li><i class="bi bi-check-circled"></i> Berbagai jenis tas rajutan tradisional.</li>
                  </ul>
                  <p>Silahkan hubungi kontak untuk info selanjutnya.</p>
                </div>
              </div>
            </div>


            <div class="swiper-slide">
              <div class="row event-item">
                <div class="col-lg-6">
                  <img src="assets/img/IMG_7576.jpg" class="img-fluid" alt="" />
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Spa Boat</h3>
                  <div class="price">
                    <p><span>Pelayanan</span></p>
                  </div>
                  <p class="fst-italic">Mengahdirkan spa yang dapat menyegarkan tubuh anda sekalian.<br>Manfaat spa :</p>
                  <ul>
                    <li><i class="bi bi-check-circled"></i> Mengurangi nyeri dan ketegangan otot.</li>
                    <li><i class="bi bi-check-circled"></i> Memberi efek relaksasi pada tubuh.</li>
                    <li><i class="bi bi-check-circled"></i> Membersihkan dan mencerahkan kulit.</li>
                  </ul>
                  <p>Silahkan hubungi kontak untuk info selanjutnya.</p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="row event-item">
                <div class="col-lg-6">
                  <img src="assets/img/IMG_7584.jpg" class="img-fluid" alt="" />
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Homestay</h3>
                  <div class="price">
                    <p><span>Pelayanan</span></p>
                  </div>
                  <p class="fst-italic">Menyediakan pelayanan homestay bagi anda yang ingin beristirahat dengan tenang.</p>
                  <ul>
                    <li><i class="bi bi-check-circled"></i> Mendapatkan pengalaman baru dan mengenal destinasi wisata lebih dalam.</li>
                    <li><i class="bi bi-check-circled"></i> Suasana yang berbeda karena area yang sangat menyatu dengan alam.</li>
                    <li><i class="bi bi-check-circled"></i> Harga yang lebih bersahabat dengan kantong.</li>
                  </ul>
                  <p>Silahkan hubungi kontak untuk info selanjutnya.</p>
                </div>
              </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <!-- End Fasilitas Section -->


        <!-- ======= Testimonials Section ======= -->





    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Galeri</h2>
          <p>Suasana dari resto</p>
        </div>
      </div>

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">
            @foreach($gallery as $galleries)
            <div class="col-lg-3 col-md-4">
              <div class="gallery-item">
                <a href="" class="gallery-lightbox" data-gall="gallery-item">
                  <img src="{{ asset('images/'.$galleries->image) }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>
            @endforeach
          </div>

      </div>
    </section><!-- End Gallery Section -->



        <!-- ======= Section ======= -->
    <section id="product" class="section reveal product">

        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Semua Produk</h2>
            <p>Produk</p>

          </div>

            <div>
                <div>
                    @if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
                </div>

                <div class="container"><br><br>
                    <div class="row">
                        <div class="col">
                            <div class="container p-3">
                                <div class="dropdown" style="position: relative; display: inline-block; margin-right: 20px;">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="background-color: #cda45e; color: white; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
                                        Semua Kategori
                                    </button>
                                    <div class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenuButton"
                                        style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px;
                                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                        @foreach ($categories as $category)
                                        <a class="dropdown-item" href="{{ route('category', $category->id) }}"
                                            style="color: black; padding: 12px 16px; text-decoration: none; display: block;">
                                            {{ $category->category_name }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="container-fluid">
                                <div class='searchbox float-end'>
                                    <form action=''>
                                        <input id="searchInput" class='serch' name='q' placeholder='Search here...' title='Cari Tulisan di Sini' type='text' style='color: #ffffff;
                                        border: none; '/>
                                            <svg style="width:20px;margin-top:10px;"  viewbox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                                            </svg>

                                        <span style='clear: both;display:block' />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="row">
                        @foreach ($products as $produc)
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-4 cardColumn">
                            <div class="product-card" tabindex="0">
                                <div class="card-content">
                                    <div class="card-cat">
                                        <a href="#" class="card-cat-link">{{$produc->product_category_name}}</a>
                                    </div>
                                    <h3 class="h3 card-title">
                                        <a href="{{route('singleproduct',$produc->id)}}">{{$produc->product_name}}</a>
                                    </h3>
                                    <data class="card-price"
                                        value="180.85">{{ 'Rp '.number_format($produc->price, 0, ',', '.') }}</data>
                                </div>
                                <figure class="card-banner">
                                    <a href="{{route('singleproduct',$produc->id)}}">
                                        @if(json_decode($produc->product_img))
                                            @foreach(json_decode($produc->product_img) as $image)
                                                <img src="{{ asset($image) }}" width="312" height="350" loading="lazy" class="image-contain" alt="">
                                            @endforeach
                                        @else
                                            <img src="{{asset($produc->product_img)}}" width="312" height="350" loading="lazy" class="image-contain">
                                        @endif
                                    </a>
                                    <ul class="card-action-list">
                                        <li class="card-action-item">
                                            @if (!Auth::check())
                                            <a href="{{ route('login') }}">
                                                <button type="button" class="card-action-btn" aria-labelledby="card-label-1">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-1">Tambah Keranjang</div>
                                            </a>
                                            @elseif(auth()->user()->hasRole('customer'))
                                            @auth
                                            <form action="{{ route('addproducttocart', $produc->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $produc->id }}" name="product_id">
                                                <input type="hidden" value="{{ $produc->product_name }}" name="product_name">
                                                <input type="hidden" value="{{ $produc->product_img }}" name="product_img">
                                                <input type="hidden" value="{{ $produc->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-1">Tambah Keranjang</div>

                                            </form>
                                            @endauth
                                            @endif
                                        </li>
                                        <li class="card-action-item">
                                            @if (!Auth::check())
                                            <a href="{{ route('login') }}">
                                                <button class="card-action-btn" aria-labelledby="card-label-3">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>

                                            </a>
                                            @else
                                            <a href="{{ route('singleproduct', $produc->id) }}">
                                                <button class="card-action-btn" aria-labelledby="card-label-3">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>

                                            </a>
                                            @endif
                                        </li>

                                    </ul>
                                </figure>
                            </div>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-center" style="">
                            {{ $products->links() }}
                        </div>
                        <center><a href="{{ route('product') }}" class="btn btn-primary ml-2" style="background-color:#cda45e; width:250px;">Lihat Semua Produk</a></center>


                    </div>
                </div>
            </div>

    </div>
      </section><!-- End Product Section -->

            <!-- ======= Book A Table Section ======= -->
            <section id="book-a-table" class="book-a-table">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>Reservation</h2>
                        <p>Book a Table</p>
                      </div>
                      @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('reservasi.store') }}" method="POST" class="reservasi">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6 form-group">
                                <label for="name">Nama:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                            <label for="phone">Telepon:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3" style="color: #f9f9f9;">
                            <label for="date">Tanggal:</label>
                            <input type="date"  class="form-control" id="date" name="date" required>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3">
                            <label for="time">Waktu:</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <div class="col-lg-4 col-md-6 form-group mt-3">
                            <label for="people">Jumlah Orang:</label>
                            <input type="number" class="form-control" id="people" name="people" required>
                        </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Pesan Tambahan:</label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div><br><br>
                        <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </form>
                </div>
            </section>
            <!-- End Book A Table Section -->

                          <section id="testimonials" class="testimonials section-bg">
                            <div class="container" data-aos="fade-up">
                              <div class="section-title">
                                <h2>Feedbacks</h2>
                                <p>Tanggapan mereka tentang resto</p>
                              </div>

                              <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                <div class="swiper-wrapper">
                                    @foreach ($feedbacks as $feedback)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <p>
                                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                                {{ $feedback->message }}
                                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                            </p>
                                            @if ($feedback->user->user_img)
                                            <img src="{{ asset($feedback->user->user_img) }}" alt="" class="testimonial-img">
                                        @else
                                            <img src="{{ asset('users/img/profil.png') }}" alt="Foto Profil" class="testimonial-img">
                                        @endif                                            <h3>{{ $feedback->user->name }}</h3>
                                            <h4>Customer</h4>
                                        </div>
                                    </div>
                                    <!-- End testimonial item -->
                                    @endforeach
                                </div>

                                <div class="swiper-pagination"></div>
                            </div>
                            </div>



                            <section id="book-a-table1" class="book-a-table">
                                <div class="container" data-aos="fade-up">
                                    <div class="section-title">
                                        <h2>Feedback</h2>
                                        <p>Berikan juga tanggapan anda</p>
                                    </div>
                                    @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    <form id="feedback-form" action="{{ route('feedback.store') }}" method="POST" class="reservasi">
                                        @csrf

                                        <div class="form-group mt-3">
                                            <center>
                                            <label for="message">Pesan Kamu:</label>
                                            <textarea class="form-control" id="message" name="message" style="height: 150px; width: 80em;" required></textarea>
                                            </center>
                                        </div><br><br>
                                        <div class="text-center">
                                            <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </section>

                          </section>


    <!-- ======= Contact Section ======= -->


    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">

          <p>Kontak Kami</p>
        </div>
      </div>

      <div data-aos="fade-up">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.521911131177!2d99.05183627501572!3d2.3292254976504374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04f44b73e473%3A0x9e2d12331e4e904e!2sPizza%20Andaliman!5e0!3m2!1sid!2sid!4v1708569925776!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Lokasi:</h4>
                <p>Jl. Patuan Nagari No.Kelurahan, Pardede Onan, Kec. Balige, Toba, Sumatera Utara 22313</p>
              </div>

              <div class="open-hours">
                <i class="bi bi-clock"></i>
                <h4>Jam Buka:</h4>
                <p>
                  Senin-Minggu:<br>
                  10:00 AM - 21.00 PM
                </p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>pizza_andaliman@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telepon:</h4>
                <p>+6281260757573</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">



          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->


          <!-- Vendor JS Files -->
          <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
          <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
          <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
          <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
          <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
          <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


          <!-- Template Main JS File -->
          <script src="{{asset('assets/js/main.js')}}"></script>
          <script>

            $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            var $cardColumns = $('.cardColumn');

            $cardColumns.each(function () {
                var cardText = $(this).text().toLowerCase();
                if (cardText.indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($cardColumns.filter(':visible').length === 0) {
                $('.no-results').show(); // Show a message if no results found
            } else {
                $('.no-results').hide(); // Hide the message if there are results
            }
        });

        $('#categoryFilter').on('change', function () {
            var selectedCategory = $(this).val();
            var $cardColumns = $('.cardColumn');

            $cardColumns.each(function () {
                var cardCategory = $(this).data('category').toLowerCase();
                if (selectedCategory === 'all' || cardCategory === selectedCategory.toLowerCase()) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($cardColumns.filter(':visible').length === 0) {
                $('.no-results').show(); // Show a message if no results found
            } else {
                $('.no-results').hide(); // Hide the message if there are results
            }
        });

        // Show "Belum ada Berita Terbaru" message if no news articles available
        if ($('.cardColumn').length === 0) {
            $('.no-results').show();
        }

            // Inisialisasi datepicker
            $("#date").datepicker({
            dateFormat: "yy-mm-dd"
        });

        // Inisialisasi timepicker
        $("#time").timepicker({
            timeFormat: 'HH:mm',
            interval: 15, // Interval dalam menit
            scrollbar: true
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.dropdown').addEventListener('mouseover', function() {
            this.querySelector('.dropdown-menu').style.display = 'block';
        });
        document.querySelector('.dropdown').addEventListener('mouseout', function() {
            this.querySelector('.dropdown-menu').style.display = 'none';
        });
    });
    document.getElementById('booking-link').addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan default action dari link
                var message = "Silahkan Anda login terlebih dahulu";
                window.location.href = this.href + '?message=' + encodeURIComponent(message);
            });

document.addEventListener("DOMContentLoaded", function() {
        if ({{ Auth::check() ? 'true' : 'false' }}) {
            var element = document.getElementById('book-a-table');
            if (element) {
                window.scrollTo({
                    top: element.offsetTop,
                    behavior: 'smooth'
                });
            }
        }
    });


        </script>
                  @endsection




