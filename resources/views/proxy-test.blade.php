<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height container">

            <div class="row">
                <div class="col-sm-12">
                    <p>Tested with:</p>
                    <p>url: http://www.google.com</p>
                    <p>ip: 173.212.202.65</p>
                    <p> port 80</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="form-container col-sm-8">
                    <h1>Proxy Tester</h1>
                    <form action="/proxy/test" method="POST">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input name="url" type="text" class="form-control" id="url" placeholder="Enter the URL">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Proxy Options</h3>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <input name="ip_address" type="text" class="form-control" id="ip-address" placeholder="Proxy IP Address">
                            </div>
                            <div class="col-sm-4">
                                <input name="port" type="text" class="form-control" id="ip-address" placeholder="Port" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                            </div>
                            <div class="col-sm-6">
                                <input name="password" type="password" class="form-control" id="password" placeholder="Password" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary ajax-submit float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="result-container">
                        <div class="row">
                            <div class=" col-sm-12 text-center"><h3 class="response-data status">Status</h3></div>
                            <div class=" col-sm-12 text-center"><h1 class="response-data response-time">Time ms</h1></div>
                            <div class="response-data general-error col-sm-12 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
    
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>

</html>
