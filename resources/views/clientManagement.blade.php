<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Manager</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script:700">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
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
</head>

<body>
    <div id="main-container" class="container bg-gray-0 border-radius-5px pv-20px mv-20px">
        <div class="row">
            <div id="right-panel" class="col-xl-12 col-lg-12 col-md-12">
                <div class="">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 float-left">
                                    <div class="row">
                                        <h2 style="font-size:16pt;"><b>User Management</b></h2>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Times</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="#">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                            Consequatur quo in incidunt adipisci, alias voluptatum aperiam deserunt
                                            quod, enim pariatur quaerat sit expedita cum, vel facilis ut inventore ipsa
                                            veniam.</a></td>
                                    <td>076465507334</td>
                                    <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium non placeat
                                        magni, aspernatur laborum, eius aperiam qui, assumenda est adipisci aliquid
                                        nesciunt numquam nemo. Voluptates iure doloremque nobis consectetur voluptas.
                                    </td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="#">Michael Holz</a></td>
                                    <td>076465507334</td>
                                    <td>Michael@gmail.com</td>
                                    <td>100</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td><a href="#">Michael Holz</a></td>
                                    <td>076465507334</td>
                                    <td>Michael@gmail.com</td>
                                    <td>2</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td><a href="#">Michael Holz</a></td>
                                    <td>076465507334</td>
                                    <td>Michael@gmail.com</td>
                                    <td>5</td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td><a href="#">Michael Holz</a></td>
                                    <td>076465507334</td>
                                    <td>Michael@gmail.com</td>
                                    <td>7</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="clearfix">
                            <div class="hint-text">Showing <b>10</b> out of <b>25</b> entries</div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="exampleModalLabel"><b>Service History</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- body of modal -->
                            <!-- <div class="table-wrapper"> -->
                            <!-- <div class="table-title">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="row">
                                                <h2 style="font-size:16pt;">2019/03/08 <b>11:00</b> - <b>12:00</b></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, odio, nobis, doloremque voluptas placeat architecto animi voluptatum veniam minus ipsam itaque? Sed quos neque explicabo tempora nobis nisi cupiditate ab.</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati eveniet facere quo, saepe inventore nostrum pariatur culpa accusantium fugiat suscipit nam aliquid quaerat voluptatibus quibusdam enim ducimus consequatur, eligendi asperiores.</td>
                                        <td>2019/11/03 10:20</td>
                                        <td><span class="badge badge-secondary">Finger nail</span></td>
                                        <td><span class="status text-warning">&bull;</span> Done</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Michael Holz</td>
                                        <td>Michael@gmail.com</td>
                                        <td>2019/11/03 10:20</td>
                                        <td><span class="badge badge-secondary">Finger nail</span></td>
                                        <td><span class="status text-warning">&bull;</span> Done</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- </div>     -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>