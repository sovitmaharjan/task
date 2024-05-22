@extends('layouts.master')

@section('page', 'Add')
@section('group', 'Music')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <p class="m-t-0 m-b-30 header-title"><b>Fields with asterisk(<span class="text-danger">*</span>) are required.</b>
                </p>
                <form method="post" action="{{ route('music.store') }}">
                    @csrf
                    <input type="hidden" id="artist_id", name="artist_id" value="{{ $artistId }}">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="title" name="title" required=""
                            value="{{ old('title') }}" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="album_name">Album Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="album_name" name="album_name" required=""
                            value="{{ old('album_name') }}" placeholder="Album Name">
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" id="genre" name="genre" required="">
                            <option value="">Select Genre</option>
                            <option value="rock" @selected(old('genre') == 'rock')>Rock</option>
                            <option value="jazz" @selected(old('genre') == 'jazz')>Jazz</option>
                            <option value="classic" @selected(old('genre') == 'classic')>Classic</option>
                            <option value="country" @selected(old('genre') == 'country')>Country</option>
                            <option value="rnb" @selected(old('genre') == 'rnb')>RNB</option>
                        </select>
                    </div>
                    
                    <div class="form-group m-t-20">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                        <a href="{{ route('music.index', $artistId) }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                    </div>
                </form>
                <!-- end row -->
            </div>
        </div>
    </div>
    
@endsection
