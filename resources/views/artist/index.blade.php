@extends('layouts.master')

@section('page', 'List')
@section('group', 'Artist')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="demo-box">
                        <div class="col-md-6">
                            <a href="{{ route('artist.create') }}"
                                class="btn btn-primary waves-effect w-md waves-light m-b-10">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('artist.export') }}"
                                class="btn btn-primary waves-effect w-md waves-light m-b-10">
                                <i class="fa fa-file-excel-o"></i> Export
                            </a>
                            <button type="button" class="btn btn-primary waves-effect w-md waves-light m-b-10"
                                data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-file-excel-o"></i> Import
                            </button>
                        </div>
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{ route('artist.import') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Excel File</label>
                                                <input class="form-control" type="file" id="file" name="file"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Import</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="form-inline">
                                        <div class="form-group m-r-10">
                                            <label>Show</label>
                                            <select class="form-control" id="entries">
                                                <option value="10" @selected($entries == 10)
                                                    data-url="{{ route('artist.index', ['entries' => 10, 'page' => 1]) }}">
                                                    10</option>
                                                <option value="25" @selected($entries == 25)
                                                    data-url="{{ route('artist.index', ['entries' => 25, 'page' => 1]) }}">
                                                    25</option>
                                                <option value="50" @selected($entries == 50)
                                                    data-url="{{ route('artist.index', ['entries' => 50, 'page' => 1]) }}">
                                                    50</option>
                                                <option value="100" @selected($entries == 100)
                                                    data-url="{{ route('artist.index', ['entries' => 100, 'page' => 1]) }}">
                                                    100</option>
                                            </select>
                                            <label>Entries</label>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-8 control-label">Search</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped m-0">
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th>Name</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>First Release Year</th>
                                        <th>No. of Album(s)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artists as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $value['name'] }}</td>
                                            <td>{{ date_format(date_create($value['dob']), 'Y-m-d') }}</td>
                                            <td>
                                                @php
                                                    echo match ($value['gender']) {
                                                        'm' => 'Male',
                                                        'f' => 'Female',
                                                        'o' => 'Other',
                                                    };
                                                @endphp
                                            </td>
                                            <td>{{ $value['address'] }}</td>
                                            <td>{{ $value['first_release_year'] }}</td>
                                            <td>{{ $value['no_of_album_released'] }}</td>
                                            <td>
                                                <a href="{{ route('music.index', $value['id']) }}"
                                                    class="btn btn-primary waves-effect btn-default m-b-5"> <i
                                                        class="fa fa-music"></i> </a>
                                                <a href="{{ route('artist.edit', $value['id']) }}"
                                                    class="btn btn-warning waves-effect btn-default m-b-5"> <i
                                                        class="fa fa-pencil"></i> </a>
                                                <button class="btn btn-danger waves-effect btn-default m-b-5 delete"
                                                    data-route="{{ route('artist.destroy', $value['id']) }}"> <i
                                                        class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="demo-box">
                        <div class="col-md-6">
                            Showing {{ $currentPage * $entries - ($entries - 1) }} to
                            {{ $currentPage * $entries < $total ? $currentPage * $entries : $total }} of
                            {{ $total }} entries
                        </div>
                        <div class="col-md-6 text-right">
                            <ul class="pagination" id="pagination">
                                @if ($total > 0)
                                    @if ($lastPage > 4)
                                        @if ($currentPage == 1)
                                            <li class="prev disabled"><a style="text-decoration: none;"><i
                                                        class="fa fa-angle-left"></i></a>
                                            </li>
                                        @else
                                            <li class="prev"><a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage - 1]) }}"><i
                                                        class="fa fa-angle-left"></i></a>
                                            </li>
                                        @endif
                                        @if ($currentPage - 1 != 1)
                                            <li class="{{ $currentPage == 1 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => 1]) }}">{{ 1 }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage - 2 >= 2)
                                            <li class="disabled">
                                                <a style="text-decoration: none; cursor: default;">...</a>
                                            </li>
                                        @endif
                                        @if ($currentPage == $lastPage)
                                            <li class="{{ $currentPage == $currentPage - 2 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage - 2]) }}">{{ $currentPage - 2 }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage > 1)
                                            <li class="{{ $currentPage == $currentPage - 1 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage - 1]) }}">{{ $currentPage - 1 }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage != 1)
                                            <li class="{{ $currentPage == $currentPage ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage]) }}">{{ $currentPage }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage < $lastPage)
                                            <li class="{{ $currentPage == $currentPage + 1 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage + 1]) }}">{{ $currentPage + 1 }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage == 1)
                                            <li class="{{ $currentPage == $currentPage + 2 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage + 2]) }}">{{ $currentPage + 2 }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage + 2 <= $lastPage - 1)
                                            <li class="disabled">
                                                <a style="text-decoration: none; cursor: default;">...</a>
                                            </li>
                                        @endif
                                        @if ($currentPage + 1 < $lastPage)
                                            <li class="{{ $currentPage == $lastPage ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $lastPage]) }}">{{ $lastPage }}</a>
                                            </li>
                                        @endif
                                        @if ($currentPage == $lastPage)
                                            <li class="next disabled"><a style="text-decoration: none;"><i
                                                        class="fa fa-angle-right"></i></a>
                                            </li>
                                        @else
                                            <li class="next"><a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage + 1]) }}"><i
                                                        class="fa fa-angle-right"></i></a>
                                            </li>
                                        @endif
                                    @else
                                        @if ($currentPage == 1)
                                            <li class="prev disabled"><a style="text-decoration: none;"><i
                                                        class="fa fa-angle-left"></i></a>
                                            </li>
                                        @else
                                            <li class="prev"><a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage - 1]) }}"><i
                                                        class="fa fa-angle-left"></i></a>
                                            </li>
                                        @endif
                                        @for ($i = 1; $i <= $lastPage; $i++)
                                            <li class="{{ $currentPage == $i ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $i]) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($currentPage == $lastPage)
                                            <li class="next disabled"><a style="text-decoration: none;"><i
                                                        class="fa fa-angle-right"></i></a>
                                            </li>
                                        @else
                                            <li class="next"><a
                                                    href="{{ route('artist.index', ['entries' => $entries, 'page' => $currentPage + 1]) }}"><i
                                                        class="fa fa-angle-right"></i></a>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
@endsection
