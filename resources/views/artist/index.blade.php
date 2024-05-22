@extends('layouts.master')

@section('page', 'List')
@section('group', 'Artist')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="demo-box">
                        <a href="{{ route('artist.create') }}" class="btn btn-primary waves-effect w-md waves-light m-b-10">
                            <i class="fa fa-plus"></i> Add
                        </a>
                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-inline">
                                    <div class="form-group m-r-10">
                                        <label>Show</label>
                                        <select class="form-control" id="entries">
                                            <option value="10" @selected($entries == 10)>10</option>
                                            <option value="25" @selected($entries == 25)>25</option>
                                            <option value="50" @selected($entries == 50)>50</option>
                                            <option value="100" @selected($entries == 100)>100</option>
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
                <div class="row">
                    <div class="demo-box col-md-6">
                        Showing {{ $currentPage * $entries - ($entries - 1) }} to
                        {{ $currentPage * $entries < $total ? $currentPage * $entries : $total }} of
                        {{ $total }} entries
                    </div>
                    <div class="demo-box col-md-6 text-right">
                        <ul class="pagination" id="pagination">
                            @if ($total > 0)
                                @if ($lastPage > 4)
                                    @if ($currentPage == 1)
                                        <li class="prev disabled"><a style="text-decoration: none;"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                    @else
                                        <li class="prev"><a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage - 1 }}"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                    @endif
                                    @if ($currentPage - 1 != 1)
                                        <li class="{{ $currentPage == 1 ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . 1 }}">{{ 1 }}</a>
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
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage - 2 }}">{{ $currentPage - 2 }}</a>
                                        </li>
                                    @endif
                                    @if ($currentPage > 1)
                                        <li class="{{ $currentPage == $currentPage - 1 ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage - 1 }}">{{ $currentPage - 1 }}</a>
                                        </li>
                                    @endif
                                    @if ($currentPage != 1)
                                        <li class="{{ $currentPage == $currentPage ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage }}">{{ $currentPage }}</a>
                                        </li>
                                    @endif
                                    @if ($currentPage < $lastPage)
                                        <li class="{{ $currentPage == $currentPage + 1 ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage + 1 }}">{{ $currentPage + 1 }}</a>
                                        </li>
                                    @endif
                                    @if ($currentPage == 1)
                                        <li class="{{ $currentPage == $currentPage + 2 ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage + 2 }}">{{ $currentPage + 2 }}</a>
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
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $lastPage }}">{{ $lastPage }}</a>
                                        </li>
                                    @endif
                                    @if ($currentPage == $lastPage)
                                        <li class="next disabled"><a style="text-decoration: none;"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    @else
                                        <li class="next"><a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage + 1 }}"><i
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
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage - 1 }}"><i
                                                    class="fa fa-angle-left"></i></a>
                                        </li>
                                    @endif
                                    @for ($i = 1; $i <= $lastPage; $i++)
                                        <li class="{{ $currentPage == $i ? 'active' : '' }}">
                                            <a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($currentPage == $lastPage)
                                        <li class="next disabled"><a style="text-decoration: none;"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    @else
                                        <li class="next"><a
                                                href="{{ route('artist.index') . '?entries=' . $entries . '&page=' . $currentPage + 1 }}"><i
                                                    class="fa fa-angle-right"></i></a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col -->
    </div>
@endsection

@push('script')
    <script>
        $(document).on('change', '#entries', function() {
            window.location.href = '{{ route('artist.index') }}' + '?entries=' + $(this).val() + '&page=1'
        });
    </script>
@endpush
