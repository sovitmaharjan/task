@extends('layouts.auth.master')

@section('content')
    @push('style')
        <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    @endpush

    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="m-t-40 account-pages">
                            <div class="text-center account-logo-box">
                                <h2 class="text-uppercase">
                                    <a href="{{ route('dashboard') }}" class="text-success">
                                        <span><img src="assets/images/logo.png" alt="" height="36"></span>
                                    </a>
                                </h2>
                                <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="first_name" name="first_name"
                                                required="" value="{{ old('first_name') }}" placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="last_name" name="last_name"
                                                required="" value="{{ old('last_name') }}" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="email" name="email"
                                                required="" value="{{ old('email') }}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" id="password" name="password"
                                                required="" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="password" id="password_confirmation"
                                                name="password_confirmation" required="" placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="phone" name="phone"
                                                required="" value="{{ old('phone') }}" placeholder="Phone">
                                        </div>
                                    </div>

                                    <div class="input-group" style="margin-bottom: 16px; border-radius: 4px">
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            required="" value="{{ old('dob') }}" placeholder="DOB">
                                        <span class="input-group-addon bg-custom b-0"><i
                                                class="mdi mdi-calendar text-white"></i></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <select class="form-control" type="text" id="gender" name="gender"
                                                required="">
                                                <option value="">Select Gender</option>
                                                <option value="m" @selected(old('gender') == 'm')>Male</option>
                                                <option value="f" @selected(old('gender') == 'f')>Female</option>
                                                <option value="o" @selected(old('gender') == 'o')>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" id="address" name="address"
                                                required="" value="{{ old('address') }}" placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="form-groupaccount-btn text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn w-md btn-danger btn-bordered waves-effect waves-light"
                                                type="submit">Register</button>
                                        </div>
                                    </div>

                                </form>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <!-- end card-box-->


                        <div class="row m-t-50">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted">Already have account?<a href="{{ route('login.index') }}"
                                        class="text-primary m-l-5"><b>Sign In</b></a></p>
                            </div>
                        </div>

                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    @push('script')
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script>
            $('#dob').datepicker({
                format: 'yyyy-mm-dd'
            });
        </script>
    @endpush
@endsection
