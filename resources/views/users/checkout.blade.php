@extends('users.layouts.templete')
@section('title','PizzaAndaliman | Check out')
@section('csss')
<style>
th, td {
        color: white;
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
.box-main h3{
    color: #cda45e;
    text-align: center;
    margin-bottom: 20px;

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

.pesan {
    background-color: rgb(0, 0, 0);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}

.pesan h3 {
    color: #cda45e;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
}

.btn-success:hover {
    background-color: #218838;
}

</style>
@endsection
@section('main-content')
<br><br><br><br><br><br>
@if (session()->has('message'))
<div id="alert" class="alert alert-success">
    {{ session()->get('message') }}
</div>
@elseif (session()->has('error'))
<div id="alert" class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<div class="container">
    <hr>
    <div class="row">
        <form action="{{route('placeorder')}}" method="POST">
            @csrf
        <div class="col-12">
            <div class="box-main">
                <h3>Pesanan Anda</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            @endphp
                       @foreach ($cart_items as $item)
                       @php
                           $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                           @endphp
                       <tr>
                           <td>
                               <!-- Tambahkan checkbox dengan atribut checked jika produk terpilih -->
                               <input type="checkbox" name="ids[]" style="display:none;" value="{{ $item->id }}" {{ in_array($item->id, $checkedItems) ? 'checked' : '' }}>
                               {{ $product_name }}
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ 'Rp '.number_format($item->price, 0, ',', '.') }}</td>
                            @php
                               $count = $item->quantity * $item->price;
                           @endphp
                           <td>{{ 'Rp '.number_format($count) }}</td>
                        </tr>
                        @php
                           $total = $total + $count;
                           @endphp
                   @endforeach

                   <tr>
                       <td></td>
                       <td></td>
                       <td>Total Harga</td>
                       <td>{{ 'Rp '.number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="box-main">
        <div class="pesan">
            <h3>Masukkan Data Pengiriman</h3>

            <div class="row g-3">
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Nama Lengkap</label>
                    <input type="hidden" name="order_id" value="{{ rand() }}">
                    <input type="text" class="form-control" id="inputEmail4" name="nama" placeholder="Penerima" required>
                        </div>
                        <div class="col-12">
                          <label for="inputAddress" class="form-label">Alamat</label>
                          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"  name="address" required>
                        </div>
                        <div class="col-12">
                          <label for="inputAddress2" class="form-label">Nomor Telepon</label>
                          <input type="text" class="form-control" id="inputAddress2" placeholder="+628..." name="shipping_phonenumber" required>
                        </div>
                        <div class="col-md-6">
                          <label for="inputCity" class="form-label">Kota</label>
                          <input type="text" class="form-control" id="inputCity"  name="shipping_city" required>
                        </div>

                        <div class="col-md-6">
                          <label for="inputZip" class="form-label">Kode Pos</label>
                          <input type="text" class="form-control" id="inputZip" name="shipping_postalcode" required>
                        </div>
                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck" @required(true)>
                              Data yang diberikan sudah benar
                            </label>
                          </div>
                        </div>
                        </div>



                    </div>
                </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-6 d-flex align-items-center">
        <a href="{{route('addtocart')}}" class="btn btn-danger" style="height: 3em; width: 100%;">Batalkan</a>
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <input type="submit" value="Lanjutkan Pembayaran" class="btn btn-primary ms-md-4" style="width: 100%;">
    </div>
</div>
</form>
</div>
<br>
<br>



</div>
@endsection
