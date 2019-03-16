<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">
    <title>Labella Nails</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
          id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/homepage.css') }}">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-purple-gradient pv-15px" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="/" id="logo-text">Labella</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#introduction">Introduction</a>
                        <a class="dropdown-item" href="#gallery">Gallery</a>
                        <a class="dropdown-item" href="#contact">Contact</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://www.bokadirekt.se/places/nail-art-of-sweden-15679">Online
                            booking</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dropin-queue">Today's Queue</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ URL::asset('/images/background1.jpg') }}">
            <div class="carousel-caption">
                <h3>Nail Service</h3>
                <a class="btn btn-default btn-outline-light btn-lg" style="color: #6648b1;"
                   href="https://www.bokadirekt.se/places/nail-art-of-sweden-15679">Book</a>
                <a class="btn btn-primary btn-lg" href="#contact">Contact</a>
            </div>
        </div>
    </div>
</div>

<!-- <hr class="my-4 hr-style-1"> -->

<div class="container padding">
    <div class="row text-center">
        <div class="col-12 mb-10px">
            <div class="anchor">
                <a class="anchor" id="introduction"></a>
                <h1 class="display-4"><a href="#introduction" class="anchor-link">#</a>Introduction</h1>
            </div>
        </div>

        <hr>

        <div class="col-12">
            <p class="lead intro-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum recusandae quis
                corporis,
                quod iusto nostrum corrupti dolor, architecto aperiam assumenda quo soluta sint dicta aut maiores
                beatae sit rem? Quaerat.</p>
        </div>
    </div>
</div>

<div class="container padding">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 text-center intro-card">
            <img class="intro-img" src="{{ URL::asset('/images/nail-polish.png') }}">
            <h3 class="intro-title">Nail service</h3>
            <p class="intro-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, necessitatibus
                officiis? Dolore
                accusantium aspernatur enim</p>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 text-center intro-card">
            <img class="intro-img" src="{{ URL::asset('/images/eyelashes.png') }}">
            <h3 class="intro-title">Eyelashes service</h3>
            <p class="intro-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, necessitatibus
                officiis? Dolore
                accusantium aspernatur enim</p>
        </div>
    </div>
</div>

<hr class="my-4 hr-style-1">

<div class="container-fluid padding">
    <div class="row text-center">
        <div class="col-12">
            <div class="anchor">
                <a class="anchor" id="gallery"></a>
                <h1 class="display-4"><a href="#gallery" class="anchor-link">#</a>Gallery</h1>
            </div>

        </div>

        <hr>
    </div>
</div>

<div id="gallery-body" class="container padding">
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <figure>
                <a href="https://mdbootstrap.com/img/Photos/Lightbox/Original/img%20(145).jpg"
                   data-size="1600x1067">
                    <img alt="picture" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(145).jpg"
                         class="img-fluid">
                </a>
            </figure>
        </div>


    </div>
</div>

<hr class="my-4 hr-style-1">
<div class="container-fluid padding">
    <div class="row text-center">
        <div class="col-12">
            <div class="anchor">
                <a class="anchor" id="contact"></a>
                <h1 class="display-4"><a href="#contact" class="anchor-link">#</a>Contact us</h1>
            </div>

        </div>
        <hr>
    </div>
</div>

<div class="container-fluid padding">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="100%" height="100%" id="gmap_canvas"
                    src="https://maps.google.com/maps?width=100%&amp;height=300&amp;hl=en&amp;coord=59.8595242,17.637519300000008&amp;q=Svartb%C3%A4cksgatan%207%2C%20753%2020%20Uppsala%2C%20Sverige+(Labella%20Nails)&amp;ie=UTF8&amp;t=&amp;z=18&amp;iwloc=B&amp;output=embed"
                    frameborder="0" scrolling="no" marginheight="5" marginwidth="5">
                    </iframe>
                </div>
            </div>
            <!-- <hr class="d-md-none"> -->
        </div>

        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <hr>
            <h4 class="text-left">Address</h4>
            <p class="text-left">Svartbäcksgatan 7, 753 20 Uppsala, Sverige</p>
            <hr>
            <h4 class="text-left">Email</h4>
            <p class="text-left">labella_not_an_official_email@gmail.com</p>
            <hr class="d-none d-md-block">
        </div>

        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <hr>
            <h4 class="text-left">Opening hours</h4>
            <p class="text-left">8a.m - 10p.m</p>

            <div class="text-left">
                <a class="btn btn-primary" href="https://www.bokadirekt.se/places/nail-art-of-sweden-15679"
                   id="footer-booking-btn">Booking</a>
            </div>

            <hr>
        </div>
    </div>
</div>
<!-- <hr class="my-4 hr-style-1"> -->

<footer class="page-footer font-small">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019
        <a href="#" id="logo-text-footer">Labella</a>
    </div>
    <!-- Copyright -->

</footer>

<script src="{{ URL::asset('/js/homepage.js') }}"></script>
</body>

</html>