<!doctype html>
<html lang="en">
    <!--<html lang="ar" dir="rtl">-->
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
        <meta name="author" content="Bdtask">
        <meta name="_token" content="{{csrf_token()}}"/>
        <title>{{appSetting()->title}}</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ (@appSetting()->favicon) ? asset('public/'.@appSetting()->favicon) : url('avatar.png')  }}">
        @include('includs.css')
        @stack('css')
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    </head>


    <body class="fixed sidebar-mini">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->


        <div class="wrapper">
            <!-- Sidebar  -->
            @include('includs.left_menu')

            <!-- Page Content  -->
            <div class="content-wrapper">
                <div class="main-content">

                    <!--Navbar-->
                    @include('includs.topmenu')
                    <!--/.navbar-->

                    <!--/.Content Header (Page header)-->
                    @yield('content')
                    <!--/.body content-->

                </div><!--/.main content-->

                <footer class="footer-content">
                    <div class="footer-text d-flex align-items-center justify-content-between">
                        <div class="copy">{{appSetting()->copy_right}}</div>
                        <div class="credit">Designed by: <a href="#">Bdtask</a></div>
                    </div>
                </footer><!--/.footer content-->
                <div class="overlay"></div>
            </div><!--/.wrapper-->
        </div>

        @include('includs.js')

        @stack('js')

        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <!-- Sweet alert -->
             <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Sweet alert -->
    </body>
</html>
