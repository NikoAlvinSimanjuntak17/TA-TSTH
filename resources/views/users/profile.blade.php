@extends('users.layouts.userprofile')
@section('title','PizzaAndaliman | Profile')
@section('profilelinks')
<head>
    <style>


        .profile-menu {
            list-style-type: none;
            padding: 0;
            background-color: transparent !important;

        }

        .profile-menu li {
            margin-bottom: 10px;

        }

        .profile-menu li a {
            display: inline-block;
            padding: 5px;
            font-size: medium;
            text-decoration: none;
        }


    </style>
</head>
<body>
    <br>
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
    <div class="col-md-4">
        <div class="profile-work">
            <h3>Menu</h3><br>
            <ul class="profile-menu bg-dark text-white">
                <li>
                    <a href="{{route('peddingorders')}}">Pesanan Saya</a>
                </li>
                <li>
                    <a href="{{route('peddingreservations')}}">Reservasi Saya</a>
                </li>
                <li>
                    <a href="{{route('feedback')}}">Feedback Saya</a>
                </li>
                <li>
                    <a href="{{route('history')}}">Riwayat Pesanan</a>
                </li>
            </ul>
        </div>
    </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="color: #0062cc">{{Auth::user()->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="color: #0062cc">{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="color: #0062cc">{{Auth::user()->phone}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Birth Date</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="color: #0062cc">{{Auth::user()->birthdate}}</p>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<br><br>
@endsection
