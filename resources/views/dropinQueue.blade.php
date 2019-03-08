<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drop-in</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
        id="bootstrap-css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet">


    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/dropinQueue.css') }}" />

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
                                <tr>
                                    <td>1</td>
                                    <td class="max-width-300px"><a href="#">Michael Holz</a></td>
                                    <td class="max-width-300px">076465507334</td>
                                    <td class="max-width-250px"><span class="badge badge-secondary">Finger nail</span></td>
                                 
                                    
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="#">Paula Wilson</a></td>
                                    <td>076465507333</td>
                                    <td><span class="badge badge-secondary">Toe nail</span></td>
                               
                                    
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="#">Antonio Moreno</a></td>
                                    <td>076465537334</td>
                                    <td><span class="badge badge-secondary">Eyelashes</span></td>
                                
                                    
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><a href="#">Mary Saveley</a></td>
                                    <td>076465507334</td>
                                    <td><span class="badge badge-secondary">Eyelashes</span></td>
                                 
                                   
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><a href="#">Martin Sommer</a></td>
                                    <td>076465507334</td>
                                    <td><span class="badge badge-secondary">Finger nail</span></td>
                                 
                                   
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><a href="#">Martin Sommer</a></td>
                                    <td>076465507334</td>
                                    <td><span class="badge badge-secondary">Finger nail</span></td>
                                
                                  
                                </tr>
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="d-flex justify-content-center mb-10px ">
                                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                            </div>
                            <div class="d-flex justify-content-center">
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
</body>

</html>