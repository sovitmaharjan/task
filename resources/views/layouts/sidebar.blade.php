<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul>
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i><span>
                            Dashboard
                        </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account"></i>
                        <span> User </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.index') }}">List</a></li>
                        <li><a href="{{ route('user.create') }}">Add</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-star-variant"></i>
                        <span> Artist </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('artist.index') }}">List</a></li>
                        <li><a href="{{ route('artist.create') }}">Add</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

        <div class="help-box">
            <h5 class="text-muted m-t-0">For Help ?</h5>
            <p class=""><span class="text-dark"><b>Email:</b></span> <br /> support@support.com</p>
            <p class="m-b-0"><span class="text-dark"><b>Call:</b></span> <br /> (+123) 123 456 789</p>
        </div>

    </div>
    <!-- Sidebar -left -->

</div>
