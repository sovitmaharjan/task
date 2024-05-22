<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('dashboard') }}" class="logo"><span>Zir<span>cos</span></span><i class="mdi mdi-cube"></i></a>
        <!-- Image logo -->
        <!--<a href="{{ route('dashboard') }}" class="logo">-->
        <!--<span>-->
        {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="" height="30"> --}}
        <!--</span>-->
        <!--<i>-->
        <!--<img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="28">-->
        <!--</i>-->
        <!--</a>-->
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">

            <!-- Navbar-left -->
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>

            <!-- Right(Notification) -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user-box">
                    <a href="" class="dropdown-toggle waves-effect waves-light user-link"
                        data-toggle="dropdown" aria-expanded="true">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-img"
                            class="img-circle user-img">
                    </a>

                    <ul
                        class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                        <li>
                            <h5>Hi, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h5>
                        </li>
                        <li>
                            <form id="logout" method="post" action="{{ route('logout') }}">
                                @csrf
                            </form>
                            <a href="javascript:void(0)" onclick="document.getElementById('logout').submit();"
                                class="dropdown-item"><i class="ti-power-off m-r-5"></i>
                                Logout</a>
                        </li>
                    </ul>
                </li>

            </ul> <!-- end navbar-right -->

        </div><!-- end container -->
    </div><!-- end navbar -->
</div>
