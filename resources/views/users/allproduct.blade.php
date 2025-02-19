@php
$categories = App\Models\Category::latest()->get();
$products = App\Models\Product::orderBy('product_name', 'asc')->get();
@endphp

@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Produk')

@section('main-content')
<br><br><br>
<style>
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
<div class="container">
    <section class="section reveal product">
        <div class="container">
            <br>

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
                                            </a>
                                        </li>
                                    </ul>
                                </figure>
                            </div>
                        </div>
                        @endforeach
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
        console.log('Mouse over dropdown');
        this.querySelector('.dropdown-menu').style.display = 'block';
    });
    document.querySelector('.dropdown').addEventListener('mouseout', function() {
        console.log('Mouse out dropdown');
        this.querySelector('.dropdown-menu').style.display = 'none';
    });
});


</script>
@endsection

