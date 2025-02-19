@extends('users.layouts.userprofile')

@section('profilecontent')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
            .header {
        background-color: #000000;
    }
    body{
        background-color: black;
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
.print:hover {
    opacity: 0.7; /* Mengubah opacity saat dihover */
}
.comment-date {
    color: #999;
    font-size: 13px;
    text-align: left;
}
    </style>
        <link rel="stylesheet" href="{{asset('users/css/navbar.css')}}">
        <link rel="stylesheet" href="{{asset('users/css/orders.css')}}">

<br><br>
    <h3>Riwayat Pemesanan</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <a href="{{ route('userprofile') }}" class="">< Kembali</a> <br><br>

    <br>
    @if($completed_orders->isEmpty())
    <center><p style="font-size: 30px; color: white;">Belum ada pesanan yang dilakukan.</p></center>
@else
@foreach ($completed_orders as $index => $order)
<div class="container">
    <div class="card bg-dark">
        <header class="card-header bg-dark @if($index === 0) show @else collapsed @endif" id="accordion-header-{{$index}}">
            <button type="button" class="header text-light" style="font-weight:bold; font-size:14px;">Nomor Pesanan : #{{$order->id}}<p class="comment-date">{{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}</p></button>
            <i class="fas fa-chevron-down" style="margin-left: 27em;" id="accordion-icon-{{$index}}"></i>
        </header>

        <div  class="card-body @if($index === 0) d-block @else d-none @endif"  id="accordion-body-{{$index}}">
            <h5 class="invoice">Pesanan Anda
                <a href="{{route('historidetil',$order->id)}}" style="text-decoration: underline; margin-left: 40em;">Lihat Detail Pesanan</a>
            </h5>
            <article class="card bg-dark">
                <div class="card-body row">
                    <div class="col"> <strong style="color: gray;">Nama Produk:</strong> <br><br>
                        @foreach (json_decode($order->product_nama) as $item)
                            <p>{{$item}}</p>
                        @endforeach
                    </div>
                    <div class="col"> <strong style="color: gray;">Jumlah:</strong> <br><br>
                        @foreach (json_decode($order->quantity) as $item)
                            <p>{{$item}}</p>
                        @endforeach
                    </div>
                    <div class="col"> <strong style="color: gray;">Status:</strong> <br><br>
                        @if($order->status == 'selesai')
                            <span class="badge badge-success" style="font-size:15px;">Selesai</span>
                        @endif
                    </div>
                    <div class="col"> <strong style="color: gray;">Tanggal Pemesanan</strong> <br><br>
                        {{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}
                    </div>
                    <div class="col"><br>
                        @if($order->status !== 'pending')
                        <a href="{{ route('print.struk', $order->id) }}" class="print">
                            <img src="{{ asset('assets/img/print.png') }}" style="width: 35px; margin-left:10px;" alt="Print"> <!-- Icon PDF dari direktori public/assets/images -->
                        </a>
                    @endif
                    </div>
                </div>
            </article>


        </div>
    </div>
</div>
@endforeach


@endif

    <br><br><br><br>
    <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
           document.addEventListener('DOMContentLoaded', function() {
        var headers = document.querySelectorAll('.card-header');
        headers.forEach(function(header, index) {
            header.addEventListener('click', function() {
                var body = document.getElementById('accordion-body-' + index);
                var icon = document.getElementById('accordion-icon-' + index);
                body.classList.toggle('d-none');
                body.classList.toggle('d-block');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });
    });
        </script>

@endsection
