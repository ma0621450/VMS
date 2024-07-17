

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link rel="stylesheet" href="public/css/styles.css"> --}}
    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    {{-- <link href="/resources/assets/lib/animate/animate.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
   <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <title>VMS</title>
</head>

<body>
    @php
        
        $role_id = request()->session()->get('role_id');
    @endphp

    


    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-success m-0">
                    <i class="fa fa-map-marker-alt me-3"></i>VMS
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto py-0">
                    @auth
                          @if ($role_id === 3 || null)
                                
                          <li class="nav-item">
                              <a class="nav-item nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            @endif
@if ($role_id === 1)
    
<li class="nav-item">
    <a class="nav-item nav-link active" aria-current="page" href="/admin/customers">Customers</a>
</li>
<li class="nav-item">
    <a class="nav-item nav-link active" aria-current="page" href="/admin/agencies">Travel Agencies</a>
</li>
<li class="nav-item">
    <a class="nav-item nav-link active" aria-current="page" href="/admin/services">Add Services</a>
</li>
<li class="nav-item">
    <a class="nav-item nav-link active" aria-current="page" href="/admin/destinations">All
        Destinations</a>
    </li>
    @endif

    @if ($role_id === 2)
        
    
    <li class="nav-item">
        <a class="nav-item nav-link active" aria-current="page" href="/agency/packages">My Packages</a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link active" aria-current="page" href="/agency/bookings">My Bookings</a>
    </li>
    <li class="nav-item">
                                <a class="nav-item nav-link active" aria-current="page" href="/agency/inquiry">Inquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item nav-link active" aria-current="page" href="/agency/profile">Your Profile</a>
                            </li>

                            @endif
                          @if ($role_id === 3)
                            <li class="nav-item">
                                <a class="nav-item nav-link active" aria-current="page" href="{{ route('user.bookings') }}">Bookings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item nav-link active" aria-current="page" href="{{ route('user.inquiry') }}">Inquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item nav-link active" aria-current="page" href="/profile">Your Profile</a>
                            </li>
                            @endif

                        <li class="nav-item">
                            <form action="/logout" method="POST">
@csrf
                                <button class="nav-item nav-link active" type="submit">Logout</button>
                            </form>
                        </li>
                    @endauth
                        

                    @guest
                        
                    <li class="nav-item">
                        <a class="nav-item nav-link active" aria-current="page" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link active" aria-current="page" href="/register">Register</a>
                    </li>
                    @endguest        
                       
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">
                        Enjoy Your Vacation With Us
                    </h1>
                        <p class="fs-4 text-white mb-4 animated slideInDown">
                            Tempor erat elitr rebum at clita diam amet diam et eos erat
                            ipsum lorem sit
                        </p>
                        <div class="position-relative w-75 mx-auto animated slideInDown">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Eg: Thailand" />
                            <button type="button"
                                class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2"
                                style="margin-top: 7px">
                                Search
                            </button>

                        </div>

                </div>
            </div>
        </div>
    </div>
    </div>