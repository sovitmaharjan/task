<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.meta')

    <title>Zircos - Responsive Admin Dashboard Template</title>

    @include('layouts.style')
</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="spinner-wrapper">
                    <div class="rotator">
                        <div class="inner-spin"></div>
                        <div class="inner-spin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')


        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">@yield('page') </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    @hasSection('group')
                                        <li class="breadcrumb-item">
                                            @yield('group')
                                        </li>
                                    @endif
                                    <li class="breadcrumb-item active">
                                        @yield('page')
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            @include('layouts.footer')

        </div>

    </div>
    <!-- END wrapper -->

    @include('layouts.script')

</body>

</html>
