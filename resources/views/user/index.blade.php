@extends('layouts.master')

@section('page', 'List')
@section('group', 'User')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="demo-box">
                        <h4 class="m-t-0 header-title"><b>Bordered table</b></h4>
                        <p class="text-muted font-13 m-b-20">
                            Add <code>.table-bordered</code> for borders on all sides of the table and cells.
                        </p>
                        <table class="table table-bordered table-striped m-0">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $value['first_name'] }} {{ $value['last_name'] }}</td>
                                        <td>{{ $value['email'] }}</td>
                                        <td>{{ $value['phone'] }}</td>
                                        <td>{{ date_format(date_create($value['dob']), 'Y-m-d') }}</td>
                                        <td>
                                            @php
                                                echo match($value['gender']) {
                                                    'm' => 'Male',
                                                    'f' => 'Female',
                                                    'o' => 'Other',
                                                }       
                                            @endphp
                                        </td>
                                        <td>{{ $value['address'] }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $value['id']) }}"
                                                class="btn btn-warning waves-effect btn-default m-b-5"> <i
                                                    class="fa fa-pencil"></i> </a>
                                            <button class="btn btn-danger waves-effect btn-default m-b-5"> <i
                                                    class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
@endsection
