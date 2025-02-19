@php
$categories = App\Models\Category::latest()->get();
@endphp

@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Category')
@section('csss')
<style>

#topbar .contact-info i {
    font-style: normal;
    color: #d9ba85;
}

#topbar .contact-info i span {
    padding-left: 5px;
    color: #fff;
}
    body {
    font-family: "Open Sans", sans-serif;
    background: #0c0b09;
    color: #fff;
}
#header {
    background: rgba(12, 11, 9, 0.6);
    border-bottom: 1px solid rgba(12, 11, 9, 0.6);
    transition: all 0.5s;
    z-index: 997;
    padding: 15px 0;
    top: 40px;
}
#header .logo a {
    color: #fff;
}
#header .logo {
    font-size: 28px;
    margin: 0;
    padding: 0;
    line-height: 1;
    font-weight: 300;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-family: "Poppins", sans-serif;
}

#header.header-scrolled {
    top: 0;
    background: rgba(0, 0, 0, 0.85);
    border-bottom: 1px solid #37332a;
}
    .product-card {
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.card-banner {
    flex: 1;
    text-align: center;
}

.card-content {
    flex: 1;
    padding: 10px;
}

.card-action-list {
    display: flex;
    justify-content: center;
    margin-right: 50px;
    margin-top: 20px;
}

.card-action-item {
    margin: 0 2px;
}

.card-action-btn {
    background-color: transparent;
    color: white;
    border: none;
    padding: 10px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.card-action-btn:hover {
    background-color: #cda45e;
}
.card-action-list {
    display: flex;
    justify-content: center;
    margin-right: 50px;
    margin-top: 20px;
}

.card-action-item {
    margin: 0 2px;
}

.card-action-btn {
    background-color: transparent;
    color: white;
    border: none;
    padding: 10px 10px;
    cursor: pointer;
    border-radius: 5px;
}

.card-action-btn:hover {
    background-color: #cda45e;
}
.card-action-tooltip {
    position: absolute;
    top: 100%; /* Change from 'bottom: 100%' to 'top: 100%' */
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    pointer-events: none;
    z-index: 999;
}
#footer {
    background: black;
    padding: 0 0 30px 0;
    color: #fff;
    font-size: 14px;
}

#footer .footer-top {
    background: #0c0b09;
    border-top: 1px solid #37332a;
    border-bottom: 1px solid #28251f;
    padding: 60px 0 30px 0;
}

#footer .footer-top .footer-info {
    margin-bottom: 30px;
}

#footer .footer-top .footer-info h3 {
    font-size: 24px;
    margin: 0 0 20px 0;
    padding: 2px 0 2px 0;
    line-height: 1;
    font-weight: 300;
    text-transform: uppercase;
    font-family: "Poppins", sans-serif;
}

#footer .footer-top .footer-info p {
    font-size: 14px;
    line-height: 24px;
    margin-bottom: 0;
    font-family: "Playfair Display", serif;
    color: #fff;
}

#footer .footer-top .social-links a {
    font-size: 18px;
    display: inline-block;
    background: #28251f;
    color: #fff;
    line-height: 1;
    padding: 8px 0;
    margin-right: 4px;
    border-radius: 50%;
    text-align: center;
    width: 36px;
    height: 36px;
    transition: 0.3s;
}

#footer .footer-top .social-links a:hover {
    background: #cda45e;
    color: #fff;
    text-decoration: none;
}

#footer .footer-top h4 {
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    position: relative;
    padding-bottom: 12px;
}

#footer .footer-top .footer-links {
    margin-bottom: 30px;
}

#footer .footer-top .footer-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

#footer .footer-top .footer-links ul i {
    padding-right: 2px;
    color: #cda45e;
    font-size: 18px;
    line-height: 1;
}

#footer .footer-top .footer-links ul li {
    padding: 10px 0;
    display: flex;
    align-items: center;
}

#footer .footer-top .footer-links ul li:first-child {
    padding-top: 0;
}

#footer .footer-top .footer-links ul a {
    color: #fff;
    transition: 0.3s;
    display: inline-block;
    line-height: 1;
}

#footer .footer-top .footer-links ul a:hover {
    color: #cda45e;
}

#footer .footer-top .footer-newsletter form {
    margin-top: 30px;
    background: #28251f;
    padding: 6px 10px;
    position: relative;
    border-radius: 50px;
    border: 1px solid #454035;
}

#footer .footer-top .footer-newsletter form input[type="email"] {
    border: 0;
    padding: 4px;
    width: calc(100% - 110px);
    background: #28251f;
    color: white;
}

#footer .footer-top .footer-newsletter form input[type="submit"] {
    position: absolute;
    top: -1px;
    right: -1px;
    bottom: -1px;
    border: 0;
    background: none;
    font-size: 16px;
    padding: 0 20px 2px 20px;
    background: #cda45e;
    color: #fff;
    transition: 0.3s;
    border-radius: 50px;
}

#footer .footer-top .footer-newsletter form input[type="submit"]:hover {
    background: #d3af71;
}

#footer .copyright {
    text-align: center;
    padding-top: 30px;
}

#footer .credits {
    padding-top: 10px;
    text-align: center;
    font-size: 13px;
    color: #fff;
}
.dropdown-menu {
    display: none !important;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-menu {
    display: block !important;
}

</style>
@endsection
@section('main-content')
<br><br><br>
<div class="container">
    <section class="section reveal product">
        <div class="container">
            <br>

            <div>

                <h2 class="h2 title_product">Kategori - {{$category->category_name}}</h2>
                <div class="container"><br><br>
                    <div class="row">
                        <div class="col">
                            <div class="container p-3">
                                <div class="dropdown" style="position: relative; display: inline-block; margin-right: 20px;">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="background-color: #cda45e; color: white; padding: 10px 20px; font-size: 16px; border: none; cursor: pointer;">
                                        Kategori
                                    </button>
                                    <div class="dropdown-menu dropdown-scroll" aria-labelledby="dropdownMenuButton"
                                        style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px;
                                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                                        <a class="dropdown-item" href="{{route('product')}}">Semua</a>

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
                        @if ($products->isEmpty())
                        <h1 class="text-center" style="margin: 2em 0em">Produk tidak tersedia</h1>
                        @else
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
                                            <a href="{{route('login')}}">
                                                <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-1">Beli Sekarang</div>
                                            </a>
                                            @elseif(auth()->user()->hasRole('customer'))
                                            @auth
                                            <form action="{{route('addproducttocart',$produc->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$produc->id}}" name="product_id">
                                                <input type="hidden" value="{{$produc->product_name}}" name="product_name">
                                                <input type="hidden" value="{{$produc->product_img}}" name="product_img">
                                                <input type="hidden" value="{{$produc->price}}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="card-action-btn" aria-labelledby="card-label-1">
                                                    <ion-icon name="cart-outline"></ion-icon>
                                                </button>
                                            </form>
                                            @endauth
                                            @endif
                                        </li>
                                        <li class="card-action-item">
                                            <a href="{{route('singleproduct',$produc->id)}}">
                                                <button class="card-action-btn" aria-labelledby="card-label-3">
                                                    <ion-icon name="eye-outline"></ion-icon>
                                                </button>
                                                <div class="card-action-tooltip" id="card-label-3">Lihat Detail</div>

                                            </a>
                                        </li>
                                    </ul>
                                </figure>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.dropdown').addEventListener('mouseover', function() {
            this.querySelector('.dropdown-menu').style.display = 'block';
        });
        document.querySelector('.dropdown').addEventListener('mouseout', function() {
            this.querySelector('.dropdown-menu').style.display = 'none';
        });
    });

</script>
@endsection

