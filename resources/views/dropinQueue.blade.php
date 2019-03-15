<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">
    <title>Queue</title>

    <!-- Google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:700">

    <!-- Bootstrap 4.3.1 -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Pretty Checkbox -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/style.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/tables.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/drop-in-queue.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/test.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}"/>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-purple-gradient pv-15px" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="#page-top" id="logo-text">Labella</a>

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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Introduction</a>
                        <a class="dropdown-item" href="#">Gallery</a>
                        <a class="dropdown-item" href="#">Contact</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Online booking</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#portfolio">Today's Queue</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="table-drop-in" class="container mt-100px">
    <div class="row d-flex justify-content-center">
        <div id="left-panel"
             class="col-xl-8 col-lg-8 col-md-10 col-sm-11 col-11 bg-gray-0 border-radius-5px pv-20px mv-20px">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle float-left" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Drop-in
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="showDropinTable();">Drop-in</a>
                                        <a class="dropdown-item" onclick="showBookingTable();">Online booking</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div href="#" class="btn btn-primary"><i class="material-icons">person</i>
                                    <span id="drop-in-res-num">20</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="drop-in-queue-table">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="max-width-300px">Name</th>
                            <th class="max-width-300px">Phone</th>
                            <th class="max-width-250px">Service</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $key => $row)
                            <tr>
                                <td>{{ ($data->currentPage()-1)*10+$row->id+101 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->telephone }}</td>
                                <td>{{ $row->type }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="table-booking" class="container mt-100px">
    <div class="row d-flex justify-content-center">
        <div id="left-panel"
             class="col-xl-8 col-lg-8 col-md-10 col-sm-11 col-11 bg-gray-0 border-radius-5px pv-20px mv-20px">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle float-left" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Booking
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="showDropinTable();">Drop-in</a>
                                        <a class="dropdown-item" onclick="showBookingTable();">Online booking</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div href="#" class="btn btn-primary"><i class="material-icons">person</i>
                                    <span id="onl-res-num">20</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="booking-table">


                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<script>
    $(document).ready(function () {
        $("#table-booking").hide();
        window.check = 0;
        $(document).on('click', '.page-link', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            console.log(window.check);
            if (window.check == 0) {
                $.ajax({
                    url: "/dropin-queue/fetch-data?page=" + page,
                    success: function (data) {
                        $('#drop-in-queue-table').html(data);
                    }
                });
            } else {
                $.ajax({
                    url: "/reservations/fetch-data?page=" + page,
                    success: function (data) {
                        $('#booking-table').html(data);
                    }
                });
            }
        }

        $.ajax({
            url: "/dropin-booking/count",
            success: function (data) {
                $('#drop-in-res-num').text(data);
            }
        });
        $.ajax({
            url: "/reservations/count",
            success: function (data) {
                $('#onl-res-num').text(data);
            }
        })
    });


    function showDropinTable() {
        window.check = 0;
        $("#table-booking").hide();
        $("#table-drop-in").show();
        $.ajax({
            url: "/dropin-queue/fetch-data?page=" + 1,
            success: function (data) {
                $('#drop-in-queue-table').html(data);
            }
        });
    }

    function showBookingTable() {
        window.check = 1;
        $("#table-drop-in").hide();
        $("#table-booking").show();
        $.ajax({
            url: "/reservations/fetch-data?page=" + 1,
            success: function (data) {
                $('#booking-table').html(data);
            }
        });
    }
</script>