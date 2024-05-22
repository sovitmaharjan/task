@extends('layouts.master')

@section('page', 'Add')
@section('group', 'User')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <p class="m-t-0 m-b-30 header-title"><b>Fields with asterisk(<span class="text-danger">*</span>) are required.</b>
                </p>
                <form method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="first_name" name="first_name" required=""
                            value="{{ old('first_name') }}" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="last_name" name="last_name" required=""
                            value="{{ old('last_name') }}" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="email" name="email" required=""
                            value="{{ old('email') }}" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="phone" name="phone" required=""
                            value="{{ old('phone') }}" placeholder="Phone">
                    </div>

                    <label for="dob">DOB <span class="text-danger">*</span></label>
                    <div class="input-group" style="margin-bottom: 16px; border-radius: 4px">
                        <input type="text" class="form-control datepicker" id="dob" name="dob" required=""
                            value="{{ old('dob') }}" placeholder="1992-01-01">
                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" id="gender" name="gender" required="">
                            <option value="">Select Gender</option>
                            <option value="m" @selected(old('gender') == 'm')>Male</option>
                            <option value="f" @selected(old('gender') == 'f')>Female</option>
                            <option value="o" @selected(old('gender') == 'o')>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="address" name="address" required=""
                            value="{{ old('address') }}" placeholder="Address">
                    </div>

                    <div class="form-group m-t-20">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <a href="{{ route('user.index') }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>
                <!-- end row -->
            </div>
        </div>
    </div>

@endsection
