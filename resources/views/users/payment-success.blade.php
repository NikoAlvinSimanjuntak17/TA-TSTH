@extends('users.layouts.userprofile')


@section('profilecontent')
<style>
    .dropdown-menu {
        display: none !important; /* Hide the dropdown menu by default */
        background-color: rgba(0, 0, 0, 0.8); /* Black with 80% opacity */
    }

    .navbar .dropdown:hover .dropdown-menu {
        display: block !important;
    }
    .dropdown-menu:hover a:hover{
        color: black !important;
    }

    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Success</div>

                <div class="card-body">
                    <p>Your payment was successful. Thank you!</p>
                    <a href="{{ route('home') }}">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


