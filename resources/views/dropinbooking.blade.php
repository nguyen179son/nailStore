<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">
    <title>Drop-in Form</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700" rel="stylesheet">

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

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/drop-in-booking.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}" />
    

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
                <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="/" role="button"
                        aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/#introduction">Introduction</a>
                        <a class="dropdown-item" href="/#gallery">Gallery</a>
                        <a class="dropdown-item" href="/#contact">Contact</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://www.bokadirekt.se/places/nail-art-of-sweden-15679">Online booking</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dropin-queue">Today's Queue</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div id="booking" class="section mt-50px">
        <div class="section-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10">
                        <div id="welcome-section" class="booking-cta">
                            <h1 id="welcome" class="welcome-text">Hej,</h1>
                            <p id="guide" class="welcome-text">Please fill in the form to reserve a seat !
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                        <div class="booking-form">
                        <form action="/dropin-booking" method="post">
                            @csrf
                            
                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Your name</span>
                                <input class="form-control" type="text" name="name" placeholder="Enter your fullname"
                                       value="{{old('name')}}">
                                <div style="height: 30px">
                                    @if ($errors->has('name'))
                                        <div class="alert" style="padding-top: 0;color: red;font-size: 12px;">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Your email</span>
                                <input class="form-control" type="text" name="email" placeholder="Enter your email" value="{{old('email')}}">
                                <div style="height: 30px">
                                    @if ($errors->has('email'))
                                        <div class="alert" style="padding-top: 0;color: red;font-size: 12px;">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Your phone</span>
                                <input class="form-control" type="text" name="telephone" placeholder="Enter your phone" value="{{old('telephone')}}">
                                <div style="height: 30px">
                                    @if ($errors->has('telephone'))
                                        <div class="alert" style="padding-top: 0;color: red;font-size: 12px;">{{ $errors->first('telephone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Service</span>
                                        <!-- <input class="form-control" type="date" required> -->

                                        <select class="form-control" name="type" id="">
                                            <option {{ old('type') == "Finger nail art" ? 'selected' : '' }}>Finger nail art</option>
                                            <option {{ old('type') == "Toe nail art" ? 'selected' : '' }}>Toe nail art</option>
                                            <option {{ old('type') == "Eyelashes" ? 'selected' : '' }}>Eyelashes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Date</span>
                                        <input id="date-picker" class="form-control" type="text" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-btn">
                                <button class="submit-btn" type="submit">Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '/' + mm + '/' + dd;
    console.log(today);

    var datePicker = document.getElementById("date-picker");
    datePicker.value = today;
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>