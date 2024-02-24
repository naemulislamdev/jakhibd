@extends('dashboard.layouts.master')
@section('title', 'Department')
@section('content')
    <div class="padding">

        <div class="box">
            <div class="box-header dker">
                    <h3>Department List</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                        <a>Department</a>
                    </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                        <li class="nav-item inline">
                            <a class="btn btn-fw primary" href="#" data-toggle="modal" data-target="#addRecords">
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
                        <th style="max-width:250px;">{{ __('Name') }}</th>
                        <th style="max-width:250px;">{{ __('Serial') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->serial }}</td>
                                <td>
                                    @if ($department->is_active == 1)
                                    <i class="fa fa-check text-success inline"></i>
                                    @elseif($department->is_active == 0)
                                    <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm success" href="#" data-toggle="modal"
                                    data-target="#editRecord__{{ $department->id }}">
                                        <i class="material-icons"></i>
                                    </a>
                                        <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#deleteMember__{{ $department->id }}">
                                            <i class="material-icons"></i>
                                        </button>
                                </td>

                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $department->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <a href="{{ route('department.destroy', $department->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editRecord__{{ $department->id }}" data-backdrop="static" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Department Type</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('department.update', $department->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name"
                                                        value="{{ $department->name }}"
                                                        placeholder="Enter name" class="form-control">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{$department->is_active == 1 ? 'selected':''}} value="1">Active</option>
                                                        <option {{$department->is_active == 0 ? 'selected':''}} value="0">Inactive</option>
                                                    </select>
                                                        @error('status')
                                                        <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Serial number</label>
                                                    <input type="number" name="serial" placeholder="Enter serial number" class="form-control" value="{{$department->serial}}">
                                                    @error('serial')
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
    <div class="modal fade" id="addRecords" tabindex="-1" data-backdrop="static" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <form action="{{ route('department.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder="Enter department name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Serial number</label>
                            <input type="number" name="serial" placeholder="Enter serial number" class="form-control">
                            @error('serial')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
