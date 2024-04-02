@extends('dashboard.layouts.master')
@section('title', 'Student')
@section('content')
<style>
    .custom-width{
        width: 30%;
    }
    .custom-width> button,.dropdown-menu{
        width: 100%;
    }
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Student List</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Student</a>
                </small>
            </div>
            <div class="box-header dker">
                <div class="dropdown custom-width">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                            $departmentName = \App\Models\Department::where('id', request()->department)->first();
                        @endphp
                        {{ $departmentName->name ?? 'বিভাগ নির্বাচন করুন' }}

                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('student.index') }}">বিভাগসমূহ</a>
                        @foreach ($departments as $department)
                            <a class="dropdown-item"
                                href="{{ route('student.index', ['department' => $department->id]) }}">{{ $department->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('student.create') }}">
                            <i class="material-icons">&#xe02e;</i>
                            New
                        </a>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th style="max-width:50px;">{{ __('SL') }}</th>
                        <th style="max-width:250px;">{{ __('image') }}</th>
                        <th style="max-width:250px;">{{ __('Name') }}</th>
                        <th style="max-width:250px;">{{ __('Department') }}</th>
                        <th style="max-width:250px;">{{ __('Roll') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@if ($student->image) {{ asset($student->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                        style="width: 50px; height:60px;">
                                </td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->department->name }}</td>
                                <td>{{ $student->roll }}</td>
                                <td style="cursor: pointer;" data-toggle="modal"
                                    data-target="#editRecord__{{ $student->id }}">
                                    @if ($student->is_active == 1)
                                        <i class="fa fa-check text-success inline"></i>
                                    @elseif($student->is_active == 0)
                                        <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm info" href="{{ route('student.show', $student->id) }}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <a class="btn btn-sm success" href="{{ route('student.edit', $student->id) }}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                        data-target="#deleteMember__{{ $student->id }}">
                                        <i class="material-icons"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $student->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                        </div>
                                        <div class="modal-body">
                                            <h6> Are you sure you want to delete?</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <a href="{{ route('student.destroy', $student->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editRecord__{{ $student->id }}" data-backdrop="static"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('student.status', $student->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{ $student->is_active == 1 ? 'selected' : '' }}
                                                            value="1">Active</option>
                                                        <option {{ $student->is_active == 0 ? 'selected' : '' }}
                                                            value="0">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
