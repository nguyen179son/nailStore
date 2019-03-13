<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<div class="container bg-gray-0 border-radius-5px pv-20px mv-20px">
    <div class="row d-flex justify-content-center">

        <div id="right-panel" class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12">

            <!-- class container -->
            <div class="">
                <div class="table-wrapper">
                    <div class="table-title">
                        <!-- <div class="row"> -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <h2 style="font-size:15pt; float: left;">2019/03/08</h2>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                    <h2 style="font-size:15pt; float: right;">
                                        <b>11:00</b> - <b>12:00</b>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                    <table class="table table-striped table-hover" id="drop-in-queue-table">
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
                                <td>{{ ($data->currentPage()-1)*10+$key+101 }}</td>
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
</body>

</html>
<script>
    $(document).ready(function () {

        $(document).on('click', '.page-link a', function (event) {
            console.log(123);
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "/queue/fetch_data?page=" + page,
                success: function (data) {
                    $('#table_data').html(data);
                }
            });
        }

    });
</script>