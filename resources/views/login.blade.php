<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">
    <title>Admin login</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
          id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/login.css') }}" />
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


    </div>
</nav>

<div id="booking" class="section mt-50px">
    <div class="section-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10">
                    <div id="welcome-section" class="booking-cta">
                        <h1 id="welcome" class="welcome-text">Labella</h1>
                        <p id="guide" class="welcome-text">Admin login
                        </p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                    <div class="booking-form">
                        <form action="{{url('admin/login')}}" method="POST" role="form">
                            @if($errors->has('errorlogin'))
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{$errors->first('errorlogin')}}
                                </div>
                            @endif

                            <div class="form-group" style="margin-bottom: 20px;">
                                <span class="form-label">Email</span>
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <p style="color:red">{{$errors->first('email')}}</p>
                                @endif
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <span class="form-label">Password</span>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                @if($errors->has('password'))
                                    <p style="color:red">{{$errors->first('password')}}</p>
                                @endif
                            </div>

                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">Login</button>

                            {{--<div class="form-btn">--}}
                                {{--<button class="submit-btn" type="submit">Book</button>--}}
                            {{--</div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>