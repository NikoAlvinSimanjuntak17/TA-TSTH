@extends('users.layouts.templete')
@section('title','Pizza Andaliman | Profile')
@section('csss')
<style>
    /* CSS untuk header */


    body{
    background: -webkit-linear-gradient(left, #000000, #000000);
    color: white !important;
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: transparent;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #ffffff;
    font-size: 40px;
}
.profile-head h6{
    color: #0062cc;
    margin-bottom: 5em;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 120px;
    padding: 5%;
    font-size: small;
    font-weight: 600;
    color: white;
    background-color: #6c757d;
    cursor: pointer;
}
.tab-pane{
    font-size: medium;
}
.proile-rating span{
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 10%;
    margin-top: -10%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 1%;
}
.profile-work a{
    text-decoration: none;
    color: #0080ff;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: transparent;
}

.file a:hover{
    color: white;
    text-decoration: none;
}
.dropdown-menu {
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
<br><br><br><br><br><br><br>
<link rel="stylesheet" href="{{asset('users/css/navbar.css')}}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
 <script type="text/javascript"
 src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{config('services.midtrans.client_key')}}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            @if (empty(Auth::user()->user_img))
                            <img src="{{asset('users/img/profil.png')}}" alt="Foto Profil">
                        @else
                            <img src="{{asset(Auth::user()->user_img)}}" alt="Foto Profil">
                        @endif
                                <a href="{{route('editprofil')}}" style="font-weight:bold;" class="file btn btn-lg btn-primary">Change Photo</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{Auth::user()->name}}
                                    </h5>
                                    <h6>
                                        Customer
                                    </h6>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="profile-edit-btn" href="{{route('editprofil')}}">
                            <i class="bi bi-gear"></i> Edit Profile
                        </a>
                    </div>


                </div>
                    @yield('profilelinks')
                   <div>
                    @yield('profilecontent')
                   </div>

            </form>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(accordion => {
            accordion.addEventListener('click', function() {
                this.classList.toggle('accordion-active');
            });
        });
    });
</script>

@endsection
