@extends('admin.layouts.template')
@section('title','Admin | peddingorders')
@section('content')
<style>
    .cekbayar {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50; /* Warna hijau */
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.cekbayar:hover {
    background-color: #45a049; /* Warna hijau lebih gelap saat hover */
}
.float-start {
        float: left;
    }

    .float-end {
        float: right;
    }

    /* Clearfix untuk membersihkan float */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    </style>
<div class="container-fluid p-5">

        <h4 class="fw-bold"><span class="text fw-light">Pages / </span> All Product</h4>


    <div class="card p-2 bg-secondary">
        <div class="container text-center">
            <div class="row">
              <div class="col text-start">
                <h4>Order Detail</h4>
                <hr>
                <p>Order Date : {{ \Carbon\Carbon::parse($pedding->created_at)->format('d M Y')}}</p>
                <h5 style="border: 1px solid black;color:chartreuse" class="p-2">Order Status Message : {{$pedding->status}}</h5>
            </div>
              <div class="col text-start">
                  <h4>Order Detail</h4>
                  <hr>
                  <p>username :  {{$pedding->nama}}  </p>
                  <p>Phone : {{$pedding->shipping_phonenumber}} </p>
                <p>Address : {{$pedding->address}}</p>
                <p>Kota : {{$pedding->shipping_city}}</p>
                <p>Postal code : {{$pedding->shipping_postalcode}}</p>
            </div>
        </div>
    </div>
        <div class="table-responsive text-nowrap container pb-4">
            <h5 class="card-header">All Product Information</h5>
            <table class="table">
                <tr>
                    <th>Nama Produk</th>
                    <th>gambar</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Pay</th>
                </tr>
                {{-- @foreach ($pedding as $pedding) --}}
                <tr>

            <td>@foreach (json_decode($pedding->product_nama) as $item)
            <p>{{$item}}</p>
        @endforeach</td>
        <td>
            @foreach(json_decode($pedding->product_img) as $item)
            <img src="{{asset($item)}}" style="width: 100px" alt="">
            @endforeach</td>
            <td>@foreach (json_decode($pedding->quantity) as $item)
                <p>{{$item}}</p>
                @endforeach</td>
                <td>@foreach (json_decode($pedding->totalprice) as $item)
                    <p>{{'Rp '.number_format($item,0,',','.')}}</p>
                    @endforeach</td>
                    <td>
                        @php
            $quantities = json_decode($pedding->quantity);
            $totalprices = json_decode($pedding->totalprice);
            @endphp
            @foreach ($quantities as $key => $item)
            @php
                $subtotal = $item * $totalprices[$key];
                @endphp
                <p>{{'Rp '.number_format($subtotal,0,',', '.') }}</p>
                @endforeach
            </td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="fw-bold">Total Amount</td>
        <td colspan="4">
            @php
            $quantities = json_decode($pedding->quantity);
            $totalprices = json_decode($pedding->totalprice);
            $total = 0;
            @endphp

@foreach ($quantities as $key => $quantity)
@php
                $subtotal = $quantity * $totalprices[$key];
                $total += $subtotal;
                @endphp
            @endforeach

            <p>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</p>
        </td>


    </tr>

    {{-- @endforeach --}}
</table>
<div class="row">
    <center><a href="https://dashboard.sandbox.midtrans.com/beta/transactions" class="cekbayar"  target="_blank"> Cek Pembayaran Order</a></center>

@if ( $pedding->status == 'in progress')
    <h4 class="mt-5">Order Procces (Order Status Updates)</h4>
@endif

<hr>
</div>

@if ($pedding->status === 'paid')
<div class="clearfix">
    <div class="float-start">
        <form method="POST" action="{{ route('approveOrder', $pedding->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Approve</button>
        </form>
    </div>
    <div class="float-end">
        <form action="{{ route('rejectOrder', $pedding->id) }}" method="GET">
            @csrf
            <input type="submit" class="btn btn-danger" value="Reject">
        </form>
    </div>
</div>

@elseif($pedding->status === 'in progress')
<div class="row d-flex">
    <div class="col">

        <form method="POST" action="{{ route('cancelOrder', $pedding->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Batalkan Konfirmasi</button>
        </form>
            </div>
            <div class="col">
        <form action="{{ route('rejectOrder', $pedding->id) }}" method="GET">
            @csrf
            <input type="submit" class="btn btn-danger" value="Tolak Pesanan">
        </form>
    </div>
</div>
@endif
</div>
</div>
<a href="{{route('pendingorder')}}" class="btn btn-secondary float-end mt-3"><- Back</a>
</div>
@endsection
