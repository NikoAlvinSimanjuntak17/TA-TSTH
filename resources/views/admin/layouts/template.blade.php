<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('admin/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Sidebar Start -->
      <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
          <a href="#" class="navbar-brand mx-4 mb-3">
            <h4 class="text-primary">Pizza Andaliman</h4>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
              <img class="rounded-circle" src="{{asset('admin/img/image.png')}}" alt="" style="width: 40px; height: 40px" />
              <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
              <h6 class="mb-0">{{Auth::user()->name}}</h6>
              <span>Admin</span>
            </div>
          </div>
          <div class="navbar-nav w-100">
            <a href="{{ route('admindasboard') }}" class="nav-item nav-link {{ Route::is('admindasboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle {{ Route::is('addproduct', 'allproduct') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Produk</a>
              <div class="dropdown-menu bg-transparent border-0">
                <a href="{{ route('addproduct') }}" class="dropdown-item {{ Route::is('addproduct') ? 'active' : '' }}">Tambah Produk</a>
                <a href="{{ route('allproduct') }}" class="dropdown-item {{ Route::is('allproduct') ? 'active' : '' }}">Semua Produk</a>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle  {{ Route::is('addcategory', 'allcategory') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Kategori</a>
              <div class="dropdown-menu bg-transparent border-0">
                <a href="{{ route('addcategory') }}" class="dropdown-item {{ Route::is('addcategory') ? 'active' : '' }}">Tambah Kategori</a>
                <a href="{{ route('allcategory') }}" class="dropdown-item {{ Route::is('allcategory') ? 'active' : '' }}">Semua Kategori</a>
              </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Route::is('admin.gallery.create', 'admin.gallery.index') ? 'active' : '' }}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Galeri</a>
                <div class="dropdown-menu bg-transparent border-0">
                  <a href="{{ route('admin.gallery.create') }}" class="dropdown-item {{ Route::is('admin.gallery.create') ? 'active' : '' }}">Tambah Galeri</a>
                  <a href="{{ route('admin.gallery.index') }}" class="dropdown-item {{ Route::is('admin.gallery.index') ? 'active' : '' }}">Semua Galeri</a>
                </div>
              </div>
            <a href="{{ route('pendingorder') }}" class="nav-item nav-link {{ Route::is('pendingorder') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Pesanan</a>
            <a href="{{ route('pendingreservation') }}" class="nav-item nav-link {{ Route::is('pendingreservation') ? 'active' : '' }}"><i class="fa fa-keyboard me-2"></i>Reservasi</a>
            <a href="{{ route('home') }}" class="nav-link{{ Route::is('home') ? 'active' : '' }}"><i class="far fa-file-alt me-2"></i>Halaman User</a>
            </div>
          </div>
        </nav>
      </div>

      <div class="content">
      <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="#" class="navbar-brand d-flex d-lg-none me-4">
          <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
          <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-nav align-items-center ms-auto">
          {{-- <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa fa-envelope me-lg-2"></i>
              <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                    <small>15 minutes ago</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                    <small>15 minutes ago</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px" />
                  <div class="ms-2">
                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                    <small>15 minutes ago</small>
                  </div>
                </div>
              </a>
              <hr class="dropdown-divider" />
              <a href="#" class="dropdown-item text-center">See all message</a>
            </div>
          </div> --}}
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0" style="width: 25rem; max-width:100%;">
                <div class="dropdown-header">Notifications</div>
                <div class="dropdown-divider"></div>
                <div class="p-2">
                    @foreach (auth()->user()->unreadNotifications as $item)
                    <div class="notification-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                        <a class="notification-link" href="{{ route('pendingorder') }}" style="font-size: 12px;">{{ $item->data['nama'] }}<br> melakukan pesanan</a><br>
                        <p class="float-end" style="font-size: 10px;">{{ $item->created_at->diffForHumans() }}</p>
                        <hr>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <a href="{{route('read',$item->id)}}" class="" style="font-size: 10px;">Mark as Read</a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img class="rounded-circle me-lg-2" src="{{asset('admin/img/image.png')}}" alt="" style="width: 30px; height: 30px" />
              <span class="d-none d-lg-inline-flex">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
              <a href="{{route('editprofileadmin')}}" class="dropdown-item" style="color: rgb(97, 81, 81);">Edit Password</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            </div>
          </div>
        </div>
      </nav>
                            {{-- <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('https://cdn.onlinewebfonts.com/svg/img_87237.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('https://cdn.onlinewebfonts.com/svg/img_87237.png') }}"
                                                            alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">Admin</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                   <li>
                                        <a class="dropdown-item" href="{{route('editprofileadmin')}}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Edit Password</span>
                                        </a>
                                    </li>
                                    {{--  <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </li> --}}
                    <div>
                    @yield('content')
                    </div>

       <!-- footer -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded-top p-4">
              <div class="row">
                <center><div class=" text-center">&copy; <a href="#">Pizza Andaliman</a>, All Right Reserved.</div></center>
              </div>
            </div>
          </div>
          <!-- Footer End -->
        </div>
        <!-- Content End -->
    </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
      </div>

      <!-- JavaScript Libraries -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{asset('admin/lib/chart/chart.min.js')}}"></script>
      <script src="{{asset('admin/lib/easing/easing.min.js')}}"></script>
      <script src="{{asset('admin/lib/waypoints/waypoints.min.js')}}"></script>
      <script src="{{asset('admin/lib/owlcarousel/owl.carousel.min.js')}}"></script>
      <script src="{{asset('admin/lib/tempusdominus/js/moment.min.js')}}"></script>
      <script src="{{asset('admin/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
      <script src="{{asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

      <!-- Template Javascript -->
      <script src="{{asset('admin/js/main.js')}}"></script>
    <script>
        $('.delete').click(function() {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

        });


    </script>
    </body>


</html>
