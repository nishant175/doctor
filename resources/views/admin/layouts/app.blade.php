<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('admin-theme/startmin-master') }}/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .error{color:#a94442;}
        </style>

        @stack('head')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!------------ SIDEBAR ------------>

            @include('admin.layouts.sidebar')

            <!------------ SIDEBAR ------------>


            <div id="page-wrapper">
                <div class="container-fluid">
                  
                  <!------ PAGE CONTENT ------>

                  @yield('content')

                  <!------ PAGE CONTENT ------>  
                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('admin-theme/startmin-master') }}/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('admin-theme/startmin-master') }}/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('admin-theme/startmin-master') }}/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('admin-theme/startmin-master') }}/js/startmin.js"></script>

        @stack('foot')

    </body>
</html>
