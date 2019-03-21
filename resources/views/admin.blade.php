<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link rel="icon" href="{{URL::asset('/images/labella_logo.png')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/tables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/navbar.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('/css/drop-in-admin.css') }}">

</head>

<body>
@csrf
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-purple-gradient" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="/" id="logo-text">Labella</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item active mr-20px">
                    <a class="nav-link" href="#">Admin page</a>
                </li>
                <li class="nav-item  mr-20px">
                    <a class="nav-link" href="/admin/customer-management">Customer Management</a>
                </li>
                <li class="nav-item mr-20px">
                    <a class="nav-link" href="/admin/complaints">Customer Complaints</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-outline-light nav-link active" href="{{ route("adminLogout") }}"
                       style="color: purple; opacity: 0.8;">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid main-container bg-gray-0 border-radius-5px pv-20px mv-20px mt-100px">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 border-right-1 left-panel">

            <div class="table-wrapper" style="padding-bottom: 0;">
                <div class="table-title filter-title">
                    <div class="row d-flex justify-content-center">

                        {{--<div class="dropdown">--}}
                        {{--<button class="btn btn-secondary dropdown-toggle float-left" type="button"--}}
                        {{--id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"--}}
                        {{--aria-expanded="false">--}}
                        {{--Drop-in--}}
                        {{--</button>--}}
                        {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        {{--<a class="dropdown-item" onclick="showDropinTable(this);">Drop-in</a>--}}
                        {{--<a class="dropdown-item" onclick="showBookingTable(this);">Online booking</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <a id="btn-show-dropin" class="btn btn-light btn-lg" style="margin-right: 10px;"
                           onclick="showDropinTable(this);">Drop-in</a>
                        <a id="btn-show-booking-online" class="btn btn-light btn-lg" onclick="showBookingTable(this);">Book</a>
                    </div>
                </div>
            </div>


            <div class="container border-radius-3px pt-20px" style="background-color: #fff;">
                <div class="form-group">
                    <span class="form-label">Date</span>
                    <input class="form-control date-picker" type="date" id="date" required>
                </div>

                <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <span class="form-label mb-10px">Service</span>
                            <div class="container-fluid">
                                <div class="row mb-10px">

                                    <div class="pretty p-default p-curve p-bigger">
                                        <input type="checkbox" class="checkbox-type" value="Pedikyr" checked/>
                                        <div class="state p-primary">
                                            <label style="padding-top: 1px;">Pedikyr</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-10px">
                                    <div class="pretty p-default p-curve p-bigger">
                                        <input type="checkbox" class="checkbox-type" value="Naglar" checked/>
                                        <div class="state p-primary">
                                            <label style="padding-top: 1px;">Naglar</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-10px">
                                    <div class="pretty p-default p-curve p-bigger">
                                        <input type="checkbox" class="checkbox-type" value="Fransar" checked/>
                                        <div class="state p-primary">
                                            <label style="padding-top: 1px;">Fransar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <span class="form-label mb-10px">Status</span>
                            <div class="container-fluid">
                                <div class="row mb-10px">

                                    <div class="pretty p-default p-round p-bigger">
                                        <input type="checkbox" class="checkbox-status" value="waiting" checked/>
                                        <div class="state p-primary">
                                            <label style="padding-top: 1px;">Waiting</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10px">

                                    <div class="pretty p-default p-round p-bigger">
                                        <input type="checkbox" class="checkbox-status" value="checked-in" checked/>
                                        <div class="state p-success">
                                            <label style="padding-top: 1px;">Checked-in</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10px">
                                    <div class="pretty p-default p-round p-bigger">
                                        <input type="checkbox" class="checkbox-status" value="done" checked/>
                                        <div class="state p-warning">
                                            <label style="padding-top: 1px;">Done</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="dropin-table" class="col-xl-9 col-lg-9 col-md-8 right-panel">
            <div class="">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <h4 class="col-sm-6">Admin Management</h4>
                            <h4 class="col-sm-4 income">Total income:</h4>
                        </div>
                    </div>
                    <div id="drop-in-queue-table">

                    </div>
                </div>
            </div>
        </div>

        <div id="booking-table" class="col-xl-9 col-lg-9 col-md-8 right-panel">
            <div class="">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <h4 class="col-sm-6">Admin Management</h4>
                            <h4 class="col-sm-4 income">Total income:</h4>
                        </div>
                    </div>
                    <div id="booking-queue-table">

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
                Do you want to delete this record
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger btn-ok" id="confirm-delete-button">Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="receipt-modal" tabindex="-1" role="dialog" aria-labelledby="add-customer-modal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel">
                            <span>Add a new customer</span>
                        </h5>
                    </div>
                    <div class="modal-body" id="history-member">
                        <div class="booking-form">

                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Staff</span>
                                <input class="form-control" type="text" id="staff" name="staff"
                                       placeholder="Staff" value="">
                                <div style="height: 30px" id="staff-error">
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Note</span>
                                <input class="form-control" type="text" id="note" name="note"
                                       placeholder="Note" value="">
                                <div style="height: 30px" id="note-error">
                                </div>
                            </div>
                            <input type="hidden" id="book-id" name="bookId">
                            <div class="form-group" style="margin-bottom: 0">
                                <span class="form-label">Payment</span>
                                <input class="form-control" type="text" id="receipt" name="receipt"
                                       placeholder="Payment" value="">
                                <div style="height: 30px" id="receipt-error">
                                </div>
                            </div>

                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                            <div id="alert-text" style="padding-top: 0; display: none;"></div>

                        </div>
                        <div class="modal-footer">
                            <button id="submit-receipt" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('/js/admin.js') }}"></script>
</body>
</html>