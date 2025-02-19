@extends('users.layouts.userprofile')
@section('profilecontent')
<style>

    .header h1 .logos{
        color: white;
    }


    </style>
<link rel="stylesheet" href="{{asset('users/css/orders.css')}}">

<br>
    <h3>Pemesanan</h3>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <a href="{{ route('userprofile') }}" class="">< Kembali</a> <br><br><br>
    @if($pending_orders->isEmpty())
    <center><p style="font-size: 30px; color: white;">Belum ada pesanan yang dilakukan.</p></center>
@else
@foreach ($pending_orders as $index => $order)
<div class="container">
    <div class="card" style="background-color: #6c757d;">
        <header class="card-header @if($index === 0) show @else collapsed @endif" id="accordion-header-{{$index}}">
            <button type="button" class="header text-light" style="font-weight:bold; font-size:15px;">Nomor Pesanan : #{{$order->id}}<p class="comment-date">{{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}</p></button>
            <i class="fas fa-chevron-down" id="accordion-icon-{{$index}}"></i>
        </header>
<div>
        <div  class="card-body @if($index === 0) d-block @else d-none @endif"  id="accordion-body-{{$index}}">
            <h6 class="invoice">Pesanan Anda
                <a href="{{route('peddingordersdetil',$order->id)}}" style="text-decoration: underline;">Lihat Detail Pesanan</a>
            </h6>
            <article class="card bg-dark">
                <div class="card-body row">
                    <div class="col"> <strong>Nama Produk:</strong> <br><br>
                        @foreach (json_decode($order->product_nama) as $item)
                            <p>{{$item}}</p>
                        @endforeach
                    </div>
                    <div class="col"> <strong>Jumlah:</strong> <br><br>
                        @foreach (json_decode($order->quantity) as $item)
                            <p>{{$item}}</p>
                        @endforeach
                    </div>
                    <div class="col"> <strong>Status:</strong> <br>
                        @if($order->status == 'pending')
                            <span class="badge badge-danger">Pending</span>
                        @elseif($order->status == 'in progress')
                            <span class="badge badge-secondary text-dark">In Progress</span>
                        @elseif($order->status == 'paid')
                            <span class="badge badge-success">Telah Dibayar</span>
                        @endif
                        @if($order->status == 'paid')
                        <p style="font-size:smaller;">*Menunggu persetujuan resto</p>
                        @else
                        <p></p>
                        @endif
                    </div>
                    <div class="col"> <strong>Tanggal Pemesanan</strong> <br>
                        {{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}
                    </div>
                </div>
            </article>

            <hr>
            @if($order->status == 'pending')
            <a href="#" class="btn pay-button" data-abc="true" style="background-color: green; color:white;" data-snap-token="{{ $order->snap_token }}">Bayar</a>
            <a href="#" class="btn btn-danger" onclick="return confirmCancellation({{$order->id}}, '{{$order->status}}', '{{ route('orderdelete', $order->id) }}')">Batalkan Pesanan</a>
            @endif
            @if($order->status !== 'pending')
    <a href="{{ route('print.struk', $order->id) }}" class="print">
        <img src="{{ asset('assets/img/print.png') }}" style="width: 30px; margin-left:62em;" alt="Print"> <!-- Icon PDF dari direktori public/assets/images -->
    </a>
@endif
        </div>
</div>
    </div>
</div>
@endforeach


@endif

      <hr>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
       var payButtons = document.querySelectorAll('.pay-button');
       payButtons.forEach(function(button) {
           button.addEventListener('click', function (event) {
               event.preventDefault(); // Mencegah aksi default button

               var snapToken = this.getAttribute('data-snap-token');
               snap.pay(snapToken, {
                onSuccess: function (result) {
    alert("Pembayaran berhasil!");
    console.log(result);

    // Redirect kembali ke halaman sebelumnya dengan mengirimkan ID pesanan
    const orderId = result.order_id;
    window.location.href = `{{ url('updateOrderStatus') }}/${orderId}`;
},

                   onPending: function (result) {
                       alert("Menunggu pembayaran Anda!");
                       console.log(result);
                   },
                   onError: function (result) {
                       alert("Pembayaran gagal!");
                       console.log(result);
                   },
                   onClose: function () {
                       alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                   }
               });
           });
       });
    });
    function confirmCancellation(orderId, orderStatus, deleteUrl) {
            if (orderStatus === 'in progress') {
                alert('Anda tidak dapat membatalkan pesanan ini karena sudah diproses oleh resto');
                return false;
            } else {
                var confirmation = confirm('Apakah anda yakin ingin membatalkan pesanan tersebut?');
                if (confirmation) {
                    window.location.href = deleteUrl;
                }
                return false;
            }
        }


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


