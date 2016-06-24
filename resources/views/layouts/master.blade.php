<!DOCTYPE html>
<html>
    <head>
        <title>W1NY @yield('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- bower:css -->
        <!-- endbower -->
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        <script src="https://js.pusher.com/3.1/pusher.min.js"></script>

        <!-- bower:js -->
        <script src="/bower_components/jquery/dist/jquery.js"></script>
        <script src="/bower_components/plotly-latest.min/index.js"></script>
        <!-- endbower -->

        <script src="js/all.js"></script>

    </body>
</html>