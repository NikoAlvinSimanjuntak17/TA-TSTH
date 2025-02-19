@extends('users.layouts.userprofile')
<style>

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
@section('profilecontent')
<br><br>
<a href="{{ route('peddingorders') }}" class="">< Kembali</a> <br><br><br>

<div class="p-2">
    <div class="card bg-dark text-white p-2">
        <div class="container text-center">
            <h4>Detail Pengiriman</h4>
            <div class="detail row">
                <div class="col-md-6 text-start">
                    <hr>
                    <p>Tanggal Pemesanan: {{ \Carbon\Carbon::parse($pedding->created_at)->format('d M Y ')}}</p>
                    <h5 style="border: 1px solid black;color:chartreuse" class="p-2">Status Pemesanan: {{$pedding->status}}</h5>
                </div>
                <div class="col-md-6 text-start">
                    <hr>
                    <p>Nama: {{$pedding->nama}}</p>
                    <p>Nomor Telepon: {{$pedding->shipping_phonenumber}}</p>
                    <p>Alamat: {{$pedding->address}}</p>
                    <p>Kota: {{$pedding->shipping_city}}</p>
                    <p>Kode Pos: {{$pedding->shipping_postalcode}}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="table-responsive container-fluid">
        <center><h4>Detail Pesanan</h4></center><br>
        <table class="table" style="color: white;">
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            {{-- @foreach ($pedding as $pedding) --}}
            <tr>

                <td>
                    @foreach (json_decode($pedding->product_nama) as $item)
                        <p>{{$item}}</p>
                    @endforeach
                </td>

                <td>
                    @foreach (json_decode($pedding->quantity) as $item)
                        <p>{{$item}}</p>
                    @endforeach
                </td>
                <td>
                    @foreach (json_decode($pedding->totalprice) as $item)
                        <p>{{'Rp '.number_format($item,0,',','.')}}</p>
                    @endforeach
                </td>
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
                <td class="fw-bold">Total Harga</td>
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
        <center>
        @if($pedding->status == 'in progress')
        <form method="POST" action="{{ route('orderDelivered', $pedding->id) }}">
            @csrf
            <button type="submit" class="btn btn-success" style="font-size: 15px;">Pesanan Telah sampai</button>
        </form>
        @endif
        </center>
    </div>

        <br><br><br>
    </div>
</div>
@endsection
