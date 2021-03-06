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

    <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/tables.css') }}">


    <link rel="stylesheet" href="{{ URL::asset('/css/client-manager.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}">

    <script src="{{ URL::asset('/js/customer.js') }}"></script>
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
<div id="main-container" class="container bg-gray-0 border-radius-5px pv-20px mv-20px mt-100px">
    <div class="row">
        <div class="col-xl-12">
            <h2 style="font-size:2rem;"><b>Customers</b></h2>
        </div>
        <div class="col-xl-6" id="flash-message">

        </div>
    </div>
    <div class="row">
        <div id="right-panel" class="col-xl-12 col-lg-12 col-md-12">
            <div class="">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 float-left">
                                <div class="row">
                                    <button type="button" class="btn btn-primary btn-lg" style="width: 100px;"
                                            data-toggle="modal" data-target="#add-customer-modal" id="add-button">
                                        Add
                                    </button>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <input class="form-control" type="text" placeholder="Search" aria-label="Search"
                                       id="keyword">
                            </div>
                        </div>
                    </div>
                    <div id="customer-table">

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="history-modal" tabindex="-1" role="dialog" aria-labelledby="history-modal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-10">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="label-customer-name-modal">Customer History
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="history-member">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="add-customer-modal" tabindex="-1" role="dialog" aria-labelledby="add-customer-modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xs-6 col-lg-6 col-md-9 col-sm-10 col-12">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="exampleModalLabel">
                                        <span>Add a new customer</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="history-member">
                                    <div class="booking-form">

                                        <div class="form-group" style="margin-bottom: 0">
                                            <span class="form-label">Code</span>
                                            <input class="form-control" type="number" id="customer-code"
                                                   name="customer_code"
                                                   placeholder="Code" pattern="[0-9]*" inputmode="numeric" value="">
                                            <div style="height: 30px" id="code-error">
                                            </div>
                                        </div>

                                        
                                        <div class="form-group" style="margin-bottom: 0">
                                            <span class="form-label">Email</span>
                                            <input class="form-control" type="email" id="email-add-customer"
                                                   name="email" placeholder="Email"
                                                   value="">
                                            <div style="height: 30px" id="email-error">

                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0">
                                            <span class="form-label">Phone number</span>
                                            <input class="form-control" type="tel" id="phone-number"
                                                   name="phone_number" placeholder="Phone number"
                                                   {{--pattern="[0-9]*" inputmode="numeric"--}}
                                                   value="">
                                            <div style="height: 30px" id="phone-error">

                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 0">
                                            <span class="form-label">Name</span>
                                            <input class="form-control text-capitalize" type="text" id="name-add-customer" name="name"
                                                   placeholder="Name" value="">
                                            <div style="height: 30px" id="name-error">
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                        <div id="alert-text" style="padding-top: 0; display: none;"></div>

                                    </div>
                                    <div class="modal-footer">
                                        <button id="submit-add-customer" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Modal -->
        <div class="modal fade" id="add-history-modal" tabindex="-1" role="dialog" aria-labelledby="add-customer-modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="exampleModalLabel">
                                        <span>Add new record to history</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="history-member">
                                    <div class="booking-form">

                                        <div class="form-group row" style="margin-bottom: 0;">
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6" style="margin-top: 6px;">
                                                <span class="form-label float-left mh-10px">Service</span>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                                <select class="form-control" name="service" id="service">
                                                    <option {{ old('type') == "Pedikyr" ? 'selected' : '' }}>Pedikyr</option>
                                                    <option {{ old('type') == "Naglar" ? 'selected' : '' }}>Naglar</option>
                                                    <option {{ old('type') == "Fransar" ? 'selected' : '' }}>Fransar</option>
                                                </select>
                                                <div style="height: 30px" id="service-error"> </div>
                                            </div>

                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-6" style="margin-top: 6px;">
                                                <span class="form-label float-left mh-10px">Payment</span>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6">
                                                <input class="form-control" type="number" id="receipt"
                                                    name="receipt"
                                                    placeholder="Payment" value="0">
                                                <div style="height: 30px" id="receipt-error">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group" hidden style="margin-bottom: 0">
                                            <span class="form-label">Status</span>
                                            <input class="form-control" type="text" id="status"
                                                   name="status"
                                                   placeholder="Code" value="Done" disabled>
                                            <div style="height: 30px" id="status-error">
                                            </div>
                                        </div>

                                        <div class="form-group row" style="margin-bottom: 0;">
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1" style="margin-top: 6px;">
                                                <span class="form-label float-left mh-10px">Staff</span>
                                            </div>
                                            <div id="staff-container" class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">

                                            </div>
                                            <input type="hidden" id="staff" name="staff" value="">
                                        </div>

                                        <div class="form-group" style="margin-top: 20px; margin-bottom: 0">
                                            <span class="form-label mh-10px">Note</span>
                                            <input class="form-control" type="text" id="note"
                                                   name="note"
                                                   placeholder="Note" value="">
                                            <div style="height: 30px" id="note-error">
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" id="cus-id" value="">
                                        <input type="hidden" name="name" id="cus-name" value="">
                                        <input type="hidden" name="email" id="cus-email" value="">
                                        <input type="hidden" name="phone_number" id="cus-phone" value="">

                                        <div id="alert-text" style="padding-top: 0; display: none;"></div>

                                    </div>
                                    <div class="modal-footer">
                                        <button id="submit-add-history" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm delete
            </div>
            <div class="modal-body">
                Do you want to delete this customer
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger btn-ok" id="confirm-delete-button">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('/js/fetchStaff.js') }}"></script>
</body>
</html>