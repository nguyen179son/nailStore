<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">
    <title>Customers</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/tables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('/css/settings.css') }}">

</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-purple-gradient" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="/" id="logo-text">Labella</a>

        {{--<a href="/admin/index" style="color: #5f27cd !important; background-color: #fff !important; border: 1px solid #fff !important;" class="btn-custom">INDEX</a>--}}

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item mr-20px">
                    <a class="nav-link" href="/admin">Admin</a>
                </li>
                <li class="nav-item active mr-20px">
                    <a class="nav-link" href="#">Customers</a>
                </li>
                <li class="nav-item mr-20px">
                    <a class="nav-link" href="/admin/complaints">Complaints</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-outline-light nav-link active" href="{{ route("adminLogout") }}"
                       style="color: purple; opacity: 0.8;">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container bg-gray-0 border-radius-5px pv-20px mv-20px mt-100px">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <h2 id="page-title" style="font-size:2rem;"><b>Settings</b></h2>
        </div>
    </div>
</div>

<div id="hompage-settings-container" class="container bg-gray-0 border-radius-5px pv-20px mv-20px">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3>Banner</h3>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Banner 1" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Banner 2" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Banner 3" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Banner 4" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Banner 5" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>
    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3>Pop-ups</h3>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Pop-up 1" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Pop-up 2" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Pop-up 3" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Pop-up 4" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to Pop-up 5" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>
    </div>

</div>

<div id="staff-settings-container" class="container bg-gray-0 border-radius-5px pv-20px mv-20px">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h3>Staff</h3>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center mv-10px">            
            <input type="text" class="form-control float-left mh-10px" placeholder="Link to RAW staff" style="width: 80%;">
            <a class="btn btn-primary mh-10px">Save</a>
            <a class="btn btn-danger mh-10px">Delete</a>
            <!-- </div> -->
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <p>Chú có thể tạo raw text link ở trang sau <a href="https://pastebin.com" target="_blank">ĐÂY</a> !</p>
        </div>
    </div>
</div>

<script src="{{ URL::asset('/js/settings.js') }}"></script>
</body>
</html>