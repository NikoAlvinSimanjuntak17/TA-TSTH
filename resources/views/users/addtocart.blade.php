@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Add To Cart')
<link rel="stylesheet" type="text/css" href="users/css/bootstrap.min.css" />
@section('csss')
<style>
.navbar .btn {
	width: 42px;
	height: 42px;
	padding: 7px;
}
th, td {
        color: white;
    }
.text-judul {
	font-weight: bold;
	font-size: 24px;
	line-height: 39px;
	color: #ffffff;
}
.text-tautan {
	font-weight: bold;
	font-size: 14px;
	line-height: 23px;
	color: #206E3A;
	text-decoration: none;
}
.text-harga {
	font-weight: 500;
	font-size: 18px;
	line-height: 30px;
	color: #ffffff;
}
.btn-tambah {
	width: 42px;
	height: 42px;
	padding: 6px 0 0 0;
}
.text-judul-halaman {
	font-weight: bold;
	font-size: 36px;
	line-height: 59px;
	color: #ffffff;
}
.img-cart {
	width: 170px;
	height: auto;
	border: 1px solid #EEEEEE;
	border-radius: 12px;
}
.input-kuantitas {
	width: 119px;
}

.card-title a {
	text-decoration: none;
	color: inherit;
}
.card-title a:hover {
	color: #35BF63;
}
tr.total,
tr.checkout {
    border: none !important;
}

.text-deskripsi {
	font-size: 14px;
	line-height: 22px;
	color: #697488;
}
.checkout tr, td{
    border: none;
}




</style>


@endsection

@section('main-content')
<div class="container">
<br><br><br><br><br><br><br><br>
@if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <div>
                    <a href="{{route('product')}}"><i class="bi bi-cart-plus"> Tambah Keranjang</i></a>
                </div>
                <form action="{{route('checkout')}}">
                <table class="table">
                    <thead>
                    <tr>
                        <td><input type="checkbox" name="" id="select_all_ids"></td>
                        <td>Gambar</td>
                        <td>Nama Produk</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart_items as $item)
                    <tbody>
                    <tr>
                        @php
                        $product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
                        $img = App\Models\Product::where('id',$item->product_id)->value('product_img');
                        @endphp
<td><input type="checkbox" name="ids[{{$item->id}}]" class="checkbox_ids" id="" value="{{$item->id}}" ></td>

                        <td><a href="{{route('singleproduct',[$item->product_id,$item->slug])}}"><img src="{{asset($img)}}" class="img-cart" style="width: 50px; height:50px;"  alt=""></a></td>
                        <td>{{$product_name}}</td>
                        <td>{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex quantity-container">
                                <a href="{{ route('products.decrement', ['id' => $item->id]) }}" class="quantity-btn">-&nbsp;&nbsp;&nbsp;</a>
                                <p class="quantity-text">{{ $item->quantity }}</p>
                                <a href="{{ route('products.increment', ['id' => $item->id]) }}" class="quantity-btn">&nbsp;&nbsp;&nbsp;+</a>
                              </div>
                        </td>
                        @php
                            $total = $item->quantity * $item->price
                        @endphp
                        <td  class="item_price" data-price="{{ $total }}">{{'Rp '.number_format($total)}}</td>
                        <td>
				    		<a href="{{route('deletecart',$item->id)}}" class="btn btn-danger rounded-circle btn-tambah">
				    			<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_54_458)">
								<path d="M1.125 16.3123C1.125 16.7599 1.30279 17.1891 1.61926 17.5056C1.93572 17.822 2.36495 17.9998 2.8125 17.9998H12.9375C13.3851 17.9998 13.8143 17.822 14.1307 17.5056C14.4472 17.1891 14.625 16.7599 14.625 16.3123V4.49982H1.125V16.3123ZM10.6875 7.31232C10.6875 7.16314 10.7468 7.02006 10.8523 6.91458C10.9577 6.80909 11.1008 6.74982 11.25 6.74982C11.3992 6.74982 11.5423 6.80909 11.6477 6.91458C11.7532 7.02006 11.8125 7.16314 11.8125 7.31232V15.1873C11.8125 15.3365 11.7532 15.4796 11.6477 15.5851C11.5423 15.6906 11.3992 15.7498 11.25 15.7498C11.1008 15.7498 10.9577 15.6906 10.8523 15.5851C10.7468 15.4796 10.6875 15.3365 10.6875 15.1873V7.31232ZM7.3125 7.31232C7.3125 7.16314 7.37176 7.02006 7.47725 6.91458C7.58274 6.80909 7.72582 6.74982 7.875 6.74982C8.02418 6.74982 8.16726 6.80909 8.27275 6.91458C8.37824 7.02006 8.4375 7.16314 8.4375 7.31232V15.1873C8.4375 15.3365 8.37824 15.4796 8.27275 15.5851C8.16726 15.6906 8.02418 15.7498 7.875 15.7498C7.72582 15.7498 7.58274 15.6906 7.47725 15.5851C7.37176 15.4796 7.3125 15.3365 7.3125 15.1873V7.31232ZM3.9375 7.31232C3.9375 7.16314 3.99676 7.02006 4.10225 6.91458C4.20774 6.80909 4.35082 6.74982 4.5 6.74982C4.64918 6.74982 4.79226 6.80909 4.89775 6.91458C5.00324 7.02006 5.0625 7.16314 5.0625 7.31232V15.1873C5.0625 15.3365 5.00324 15.4796 4.89775 15.5851C4.79226 15.6906 4.64918 15.7498 4.5 15.7498C4.35082 15.7498 4.20774 15.6906 4.10225 15.5851C3.99676 15.4796 3.9375 15.3365 3.9375 15.1873V7.31232ZM15.1875 1.12482H10.9688L10.6383 0.467401C10.5683 0.326851 10.4604 0.208624 10.3269 0.126019C10.1934 0.0434148 10.0394 -0.000289557 9.88242 -0.000176942H5.86406C5.7074 -0.000779187 5.55373 0.0427622 5.42067 0.125459C5.28761 0.208155 5.18054 0.326662 5.11172 0.467401L4.78125 1.12482H0.5625C0.413316 1.12482 0.270242 1.18409 0.164752 1.28958C0.0592632 1.39506 0 1.53814 0 1.68732L0 2.81232C0 2.96151 0.0592632 3.10458 0.164752 3.21007C0.270242 3.31556 0.413316 3.37482 0.5625 3.37482H15.1875C15.3367 3.37482 15.4798 3.31556 15.5852 3.21007C15.6907 3.10458 15.75 2.96151 15.75 2.81232V1.68732C15.75 1.53814 15.6907 1.39506 15.5852 1.28958C15.4798 1.18409 15.3367 1.12482 15.1875 1.12482Z" fill="white"/>
								</g>
								<defs>
								<clipPath id="clip0_54_458">
								<rect width="15.75" height="18" fill="white"/>
								</clipPath>
								</defs>
								</svg>

				    		</a>
				    	</td>
                    </tr>
                    <div class="checkout">
                    @php
                        $total = $total + $item->price;
                    @endphp
                        @endforeach
                        @if ($total >0)
                    <tr>
                        <td>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Harga</td>
                        <td id="total_price">{{'Rp '.number_format(0)}}</td>
                        <td></td>
                        </tr>

                        <tr>
                            <td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td><br>
                            <td colspan="2">
                            </td>
                            <td></td>
                        </tr>
                        @endif
                    </div>
                </tbody>
            </table><br><br>
            <input type="submit" class="btn btn-lg btn-success w-100" value="Checkout">
                </form>

            </div>




        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function calculateTotal() {
  var total = 0; //Inisialisasi variabel total dengan nilai 0.
  $('.checkbox_ids:checked').each(function() { //Menggunakan selector $('.checkbox_ids:checked') untuk memilih semua checkbox dengan class checkbox_ids yang sedang dicek dan Looping menggunakan fungsi .each() untuk setiap checkbox yang dipilih.
    var price = parseFloat($(this).closest('tr').find('.item_price').data('price')); //Di dalam loop, mengambil nilai harga dari elemen dengan class .item_price yang berada dalam row (<tr>) terdekat dari checkbox yang sedang dicek. Nilai harga diambil dengan menggunakan .data('price') yang mengambil data price dari elemen tersebut.Mengkonversi nilai harga menjadi tipe data float dengan parseFloat().
    total += price; //Menambahkan nilai harga ke variabel total.
  });

  if (total > 0) {
    var total_string = 'Rp ' + formatPrice(total);
//Jika total lebih besar dari 0, maka:
//Variabel total_string dibuat dengan format 'Rp ' + formatPrice(total). Format ini digunakan untuk menampilkan harga dengan format mata uang.
//Mengubah isi elemen dengan id total_price menjadi total_string, sehingga tampilan total harga diperbarui.
    $('#total_price').text(total_string);
  } else {
    $('#total_price').text('Rp 0');
  }
//Jika total kurang dari atau sama dengan 0, maka:
//Mengubah isi elemen dengan id total_price menjadi 'Rp 0', menunjukkan bahwa total harga adalah 0.
}

function formatPrice(price) { // Mendefinisikan fungsi formatPrice(price) yang menerima argumen price (harga).
  var price_string = price.toFixed(0).toString(); // Menggunakan fungsi .toFixed(0) untuk membulatkan harga ke angka tanpa desimal. dan Mengkonversi harga menjadi string dengan toString().
  var formatted_price = ''; //Mendefinisikan variabel formatted_price untuk menyimpan harga yang diformat.
  var last_index = price_string.length - 1; // Menghitung indeks terakhir dari harga dalam string dengan last_index = price_string.length - 1.

  for (var i = last_index; i >= 0; i--) { //Melakukan loop mundur dari indeks terakhir hingga indeks pertama harga.
    formatted_price = price_string[i] + formatted_price; //Di dalam loop, menambahkan setiap digit harga ke awal formatted_price dengan menggunakan formatted_price = price_string[i] + formatted_price.
    var digit_index_from_right = last_index - i; //Menghitung indeks digit dari kanan ke kiri dengan digit_index_from_right = last_index - i.
    if (digit_index_from_right % 3 == 2 && i > 0) { //Jika indeks digit dari kanan ke kiri merupakan kelipatan 3 (digit ke-2, 5, 8, dst.) dan bukan digit pertama, maka tambahkan tanda titik sebagai pemisah ribuan dengan formatted_price = '.' + formatted_price.
      formatted_price = '.' + formatted_price;
    }
  }

  return formatted_price; ////Mengembalikan formatted_price yang merupakan harga yang diformat dengan tanda titik sebagai pemisah ribuan.
}

$(function() {
  // Checkbox all
  $('#select_all_ids').click(function() {
    $('.checkbox_ids').prop('checked', $(this).prop('checked'));//baris ini akan mengubah properti checked (centang) dari semua elemen dengan class checkbox_ids menjadi nilai yang sama dengan properti checked dari elemen yang diklik ($(this).prop('checked')).
    calculateTotal();
  });

  $('.checkbox_ids').click(function() {
    calculateTotal();
  });
});

</script>

@push('js')

@endpush
@endsection
