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
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/#introduction">Introduction</a>
                        <a class="dropdown-item" href="/#gallery">Gallery</a>
                        <a class="dropdown-item" href="/#contact">Contact</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://www.bokadirekt.se/places/nail-art-of-sweden-15679">Online
                            booking</a>
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
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <a id="btn-show-dropin-1" class="btn btn-light btn-lg" style="margin-right: 10px;"
                                   onclick="showDropinTable();">Drop-in</a>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <a id="btn-show-booking-online-1" class="btn btn-light btn-lg"
                                   onclick="showBookingTable();">Online booking</a>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
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
                            <th width="10%">#</th>
                            <th width="50%">Name</th>
                            <th width="20%">Phone</th>
                            <th width="20%">Service</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $key => $row)
                            <tr style="word-break: break-all" data-email="{{$row->email}}" data-toggle="modal" data-target="#fill-in-code" data-id="{{$row->id}}">
                                <td>{{ ($data->currentPage()-1)*10+$row->id+101 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ substr($row->telephone, 0, 4) . '****' . substr($row->telephone,  -4)}}</td>
                                <td>{{ $row->type }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!! $data->links() !!}
                </div>
                <div class="col-xl-12" style="text-align: center" id="flash-message">

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
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <a id="btn-show-dropin-2" class="btn btn-light btn-lg" style="margin-right: 10px;"
                                   onclick="showDropinTable();">Drop-in</a>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <a id="btn-show-booking-online-2" class="btn btn-light btn-lg"
                                   onclick="showBookingTable();">Online booking</a>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div href="#" class="btn btn-primary"><i class="material-icons">person</i>
                                    <span id="onl-res-num">20</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="booking-table">


                </div>
                <div class="col-xl-12" style="text-align: center" id="flash-message">

                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="fill-in-code" tabindex="-1" role="dialog" aria-labelledby="fill-in-code"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="container">
            <div class="row d-flex justify-content-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                <span>Fill in your code</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="history-member">
                            <div class="booking-form">

                                <div class="form-group" style="margin-bottom: 0">
                                    <span class="form-label">Code</span>
                                    <input class="form-control" type="text" id="code"
                                           name="code" placeholder="Code"
                                           value="">
                                    <div style="height: 30px" id="error">

                                    </div>
                                </div>
                                <input type="hidden" name="email" id="email" value="">
                                <input type="hidden" name="id" id="book-id" value="">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                <div id="alert-text" style="padding-top: 0; display: none;"></div>

                            </div>
                            <div class="modal-footer">
                                <button id="submit-add-customer" class="btn btn-primary">Done</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ URL::asset('/js/dropin-queue.js') }}"></script>
</body>

</html>