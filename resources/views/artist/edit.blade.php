@extends('layouts.master')

@section('page', 'Add')
@section('group', 'Artist')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <p class="m-t-0 m-b-30 header-title"><b>Fields with asterisk(<span class="text-danger">*</span>) are required.</b>
                </p>
                <form method="post" action="{{ route('artist.update', $artist['id']) }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="name" name="name" required=""
                            value="{{ old('name', $artist['name']) }}" placeholder="Name">
                    </div>

                    <label for="dob">DOB <span class="text-danger">*</span></label>
                    <div class="input-group" style="margin-bottom: 16px; border-radius: 4px">
                        <input type="text" class="form-control datepicker" id="dob" name="dob" required=""
                            value="{{ old('dob', date_format(date_create($artist['dob']), 'Y-m-d')) }}" placeholder="1992-01-01">
                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" id="gender" name="gender" required="">
                            <option value="">Select Gender</option>
                            <option value="m" @selected(old('gender') == 'm' || $artist['gender'] == 'm')>Male</option>
                            <option value="f" @selected(old('gender') == 'f' || $artist['gender'] == 'f')>Female</option>
                            <option value="o" @selected(old('gender') == 'o' || $artist['gender'] == 'o')>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="address" name="address" required=""
                            value="{{ old('address', $artist['address']) }}" placeholder="Address">
                    </div>

                    <div class="form-group">
                        <label for="first_release_year">First Release Year <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="first_release_year" name="first_release_year" required=""
                            value="{{ old('first_release_year', $artist['first_release_year']) }}" placeholder="1992">
                    </div>

                    <div class="form-group">
                        <label for="no_of_album_released">No. of Albums <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="no_of_album_released" name="no_of_album_released" required=""
                            value="{{ old('no_of_album_released', $artist['no_of_album_released']) }}" placeholder="9">
                    </div>

                    <div class="form-group m-t-20">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <a href="{{ route('artist.index') }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>
                <!-- end row -->
            </div>
        </div>
    </div>
    
@endsection
