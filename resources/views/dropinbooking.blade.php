<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Booking Form HTML Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <!-- <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/dropinbooking.css') }}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="booking" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-push-5 col-sm-12 col-xs-12">
                    <div id="welcome-text" class="booking-cta">
                        <h1>Make your reservation</h1>
                        <p>Please fill in the form to reserve a seat !
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-md-pull-7 col-sm-12 col-xs-12">
                    <div class="booking-form">
                        <form action="/dropinBooking" method="post">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <span class="form-label">Your name</span>
                                <input class="form-control" type="text" name="name" placeholder="Enter your fullname"
                                       value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <span class="form-label">Your email</span>
                                <input class="form-control" type="text" name="email" placeholder="Enter your email" value="{{old('email')}}">
                            </div>

                            <div class="form-group">
                                <span class="form-label">Your phone</span>
                                <input class="form-control" type="text" name="telephone" placeholder="Enter your phone" value="{{old('telephone')}}">
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