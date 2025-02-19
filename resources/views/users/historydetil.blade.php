@extends('users.layouts.userprofile')

@section('profilecontent')
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
<br><br><br>
<a href="{{ route('history') }}" class="">< Kembali</a> <br><br><br>

<div class="p-2">
    <div class="card p-2" style="background-color: transparent;">

        <div class="container text-center">
            <h4>Detail Pemesanan</h4>
            <div class="row">
              <div class="col">
                <hr>
                <p>Nomor Pemesanan : {{$pedding->id}}</p>
                <p>Tanggal Pemesanan : {{ \Carbon\Carbon::parse($pedding->updated_at)->format('d M Y')}}</p>
                <h5 style="border: 1px solid black;color:chartreuse" class="p-2">Status Pemesanan : {{$pedding->status}}</h5>
            </div>
              <div class="col ">
                  <hr>
                  <p>Nama Pemesan : {{$pedding->nama}} </p>
                  <p>Alamat Tujuan : {{$pedding->address}}</p>
                  <p>Nomor Telepon : {{$pedding->shipping_phonenumber}} </p>
            </div>
        </div><br><br>
    </div>
    <div class="table-responsive container-fluid">
                <h5>Semua Informasi Produk Pemesanan</h5>
                <hr>
            <table class="table text-secondary">
                <tr>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
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
    </table><br><br><br>
    </div>
    <div>
       @if (empty($pedding->ulasan))
       <div class="row">
        <div class="mb-3">
            <h3>Beri komentar</h3>
            <form action="{{ route('komentar.post', ['id' => $pedding->id]) }}" method="POST">
                @csrf
            <textarea name="ulasan" name="ulasan" id="" cols="" style="width: 100%; background-color:transparent;" rows="10" placeholder="Ayo Beri Komentar...."></textarea><br>
            <input type="submit" name="" value="Beri Komentar" id="" class="btn btn-success">
            </form>


        </div>
    </div>
    @elseif(!empty($pedding->ulasan))
    <div class="mb-3">
        <h2>Ulasan Anda :</h2>
        <textarea name=""  id="" cols="95" rows="10" disabled class="p-3" style="width: 100%">{{$pedding->ulasan}}</textarea>
                      </div>
</div>
       @endif
    </div>
    </div>
</div>
</div>

@endsection
