@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Product')

@section('csss')
<link rel="stylesheet" href="{{asset('users/css/style.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    #topbar .contact-info i {
    font-style: normal;
    color: #d9ba85;
    }
    #topbar .contact-info i span {
        padding-left: 5px;
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
    #header.header-scrolled {
    top: 0;
    background: rgba(0, 0, 0, 0.85);
    border-bottom: 1px solid #37332a;
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

#header .logo a {
    color: #fff;
}

#header .logo img {
    max-height: 40px;
}
    body{
        background-color: black !important;
        margin-top: 150px !important;
    }

.ratings-container {
    margin-top: 10px;
}

.rating {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
}

.user-name {
    font-weight: bold;
}

.comment-date {
    color: #999;
    font-size: 13px;
}

.dropdown-menu {
    display: none !important; /* Hide the dropdown menu by default */
    background-color: rgba(0, 0, 0, 0.8); /* Black with 80% opacity */
}

.navbar .dropdown:hover .dropdown-menu {
    display: block !important; /* Show the dropdown menu when the dropdown toggle is hovered */

}
.navbar .dropdown .dropdown-menu a:hover{
    color: black;
}



</style>
@endsection
@section('main-content')
<br><br>
<!-- Start slides -->
<div class="container">
    <br><br>
    <div class="product-slides">

        <div class="slider-banner" data-slider>
            <figure class="product-banner">
                      <a href="{{route('product')}}"><i class="bi bi-arrow-left"> Back</i></a><br><br>
                    <img src="{{asset($product->product_img)}}" width="600" height="600" loading="lazy" alt="{{$product->product_name}}"
                      class="img-cover">
                  </figure>

              </div>

              <div class="detail">
              <div class="product-content">

                <p class="product-subtitle" style="color: #cda45e;">{{$product->product_category_name}}</p>

                <h1 class="h1 product-title" style="color:white;">{{$product->product_name}}</h1>

                <p class="product-text" style="color: gray;">
                  {{$product->product_deskripsi}}
                </p>

                <div class="wrapper">

                  <span class="price" data-total-price style="color: gray;">{{'Rp '.number_format($product->price, 0, ',', '.') }}</span>

                </div>
                @if (!Auth::check())
                        <a href="{{route('login')}}" class="btn btn-success">Login to Add to Cart</a>
                    @elseif(auth()->user()->hasRole('customer'))
                        @auth
                <form action="{{route('addproducttocart')}}" method="POST" class="add-to-cart-form">
                  @csrf
                  <div class="btn-group">

                  <div class="counter-wrapper">


                    <input type="hidden" value="{{$product->id}}" name="product_id">
                    <input type="hidden" value="{{$product->product_name}}" name="product_name">
                    <input type="hidden" value="{{$product->product_img}}" name="product_img">
                    <input type="hidden" value="{{$product->price}}" name="price">
                    <label for="quantity">Quantity:</label>
                <input class="form-control" type="number" min="1" value="1" name="quantity">


                  </div>

                  <button class="cart-btn">
                    <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>

                    <span class="span">Tambah Keranjang</span>
                  </button>

                </div>
              </form>
              @endauth
              @endif

              </div>
              </div>

            </div>
<br><br><br><br>

    <!-- Ratings -->
    <h1>Ulasan</h1>
    <div class="ratings-container">
            @foreach ($comments as $index => $comment)
                <div class="rating">
                    <div class="comment">{{$comment}}</div>
                    @if (isset($createdDates[$index]))
                        <div class="comment-date">{{$userNames[$index]}} - {{$createdDates[$index]->diffForHumans()}}</div>
                    @endif
                </div>
            @endforeach
    </div>

</div>
<br><br><br><br>

<div class="container">
    <h2 class="h2 title_product">Produk Sejenis</h2>
    <div>
        <ul class="product-list">

            @foreach ($related_products->take(4) as $produc)
            @if ($produc->product_name !== $product->product_name)
        <li class="product-item">
          <div class="product-card" tabindex="0">

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
            </figure>                    <div class="card-content">

                      <div class="card-cat">
                        <a href="#" class="card-cat-link">{{$produc->product_category_name}}</a>
                      </div>

                      <h3 class="h3 card-title">
                        <a href="#">{{$produc->product_name}}</a>
                      </h3>

                      <data class="card-price">{{'Rp '.number_format($produc->price, 0, ',', '.')}}</data>

                    </div>

                  </div>
                </li>
                @endif
                @endforeach
                  </div>
                </li>
              </ul>

            </div>
        </div>
        <br><br><br><br><br>
    <!-- JS for Toggle menu -->



@endsection
  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
      var MenuItems = document.getElementById("MenuItems");

      MenuItems.style.maxHeight = "0px";

      function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
          MenuItems.style.maxHeight = "200px";
        } else {
          MenuItems.style.maxHeight = "0px";
        }
      }
    </script>


