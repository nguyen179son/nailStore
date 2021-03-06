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

<div id="booking" class="section mt-100px" style="padding-bottom: 50px;">
    <div class="section-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 mt-150px">
                    <div id="welcome-section" class="booking-cta">
                        <h1 id="welcome" class="welcome-text">Hej,</h1>
                        <p id="guide" class="welcome-text">Please fill in the form to reserve a seat !</p>
                        <p>Waiting queue: <span style="text-decoration: underline; color: chartreuse;">https://bit.ly/temp-queue</span></p>
                        {{--<p><a style="text-decoration: underline; color: #f1c40f;" href="/dropin-queue">Waiting queue</a></p>--}}
                    </div>
                </div>
            </div>
            {{--<div class="row d-flex justify-content-center">--}}
                {{--<div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">--}}
                    {{--<div class="booking-form">--}}
                        {{--<button class="btn btn-primary" style="min-width: 100px; padding: 10px 20px; margin-left: 10px; margin-right: 10px;">Code</button>--}}
                        {{--<button class="btn btn-primary" style="min-width: 100px; padding: 10px 20px; margin-left: 10px; margin-right: 10px;">Code</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
                    <div class="booking-form">

                        <div style="margin-bottom: 30px; margin-left: auto; margin-right: auto;">
                            <a onclick="showBookCode(this);" id="btn-book-code" class="btn btn-light" style="min-width: 100px; padding: 10px 20px; margin-left: 10px; margin-right: 10px;">Code</a>
                            <a disabled onclick="showBookName(this);" id="btn-book-name" class="btn btn-light" style="min-width: 100px; padding: 10px 20px; margin-left: 10px; margin-right: 10px;">Name</a>
                        </div>

                        <hr>

                        <form id="book-code" action="/dropin-booking" method="post">
                            @csrf
                            @if (Session::has('message'))
                                <div class="alert alert-info fade-message">{{ Session::get('message') }}</div>
                                <script>
                                    $(function(){
                                        setTimeout(function() {
                                            $('.fade-message').slideUp();
                                        }, 3000
                                        );
                                    });
                                </script>
                            @endif

                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Customer code</span>
                                <input class="form-control" type="number" name="code" placeholder="Enter your code" value="{{old('code')}}">
                                <div style="height: 30px">
                                    @if ($errors->has('code'))
                                        <div class="alert" style="padding-top: 0;color: red;font-size: 12px;">{{ $errors->first('code') }}</div>
                                    @endif
                                </div>
                                {{--<h6 style="width:100%; text-align:center; border-bottom: 1px solid #000; line-height:0.1em; margin:10px 0 20px;">--}}
                                    {{--<span style="background:#fff; padding:0 10px;">--}}
                                        {{--OR--}}
                                    {{--</span>--}}
                                {{--</h6>--}}
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Service</span>
                                        <!-- <input class="form-control" type="date" required> -->

                                        <select class="form-control" name="type" id="">
                                            <option {{ old('type') == "Pedikyr" ? 'selected' : '' }}>Pedikyr</option>
                                            <option {{ old('type') == "Naglar" ? 'selected' : '' }}>Naglar</option>
                                            <option {{ old('type') == "Fransar" ? 'selected' : '' }}>Fransar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="form-label">Date</span>
                                        <input id="date-picker-1" class="form-control" type="text" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-btn">
                                <button class="submit-btn" type="submit">Book</button>
                            </div>
                        </form>
                        <form id="book-name" action="/dropin-booking" method="post">
                            @csrf
                            @if (Session::has('message'))
                                <div class="alert alert-info fade-message">{{ Session::get('message') }}</div>
                                <script>
                                    $(function(){
                                        setTimeout(function() {
                                            $('.fade-message').slideUp();
                                        }, 3000);
                                    });
                                </script>
                            @endif
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
                                <input class="form-control" type="number" name="telephone" placeholder="Enter your phone" value="{{old('telephone')}}">
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
                                            <option {{ old('type') == "Pedikyr" ? 'selected' : '' }}>Pedikyr</option>
                                            <option {{ old('type') == "Naglar" ? 'selected' : '' }}>Naglar</option>
                                            <option {{ old('type') == "Fransar" ? 'selected' : '' }}>Fransar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                <span class="form-label">Date</span>
                                <input id="date-picker-2" class="form-control" type="text" disabled>
                                </div>
                                </div>
                            </div>
                            <hr>

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

    var datePicker1 = document.getElementById("date-picker-1");
    datePicker1.value = today;

    var datePicker2 = document.getElementById("date-picker-2");
    datePicker2.value = today;

    $(document).ready(function() {
        $("#book-code").show();
        $("#book-name").hide();
        $("#btn-book-code").addClass('active');
    })

    function showBookCode(element) {
        $("#book-code").show();
        $("#book-name").hide();

        $("#btn-book-code").addClass('active');
        $("#btn-book-name").removeClass('active');
    }

    function showBookName(element) {
        $("#book-name").show();
        $("#book-code").hide();

        $("#btn-book-code").removeClass('active');
        $("#btn-book-name").addClass('active');
    }
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>