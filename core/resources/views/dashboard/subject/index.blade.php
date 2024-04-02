@extends('dashboard.layouts.master')
@section('title', 'Subject')
@section('content')
    <div class="padding">

        <div class="box">
            <div class="box-header dker">
                    <h3>Subject List</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                        <a>subject</a>
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
                        <th style="max-width:250px;">{{ __('Subject Name') }}</th>
                        <th style="max-width:250px;">{{ __('Subject description') }}</th>
                        <th style="max-width:250px;">{{ __('Department') }}</th>
                        <th style="max-width:250px;">{{ __('Serial') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->description }}</td>
                                <td>{{ $subject->department->name }}</td>
                                <td>{{ $subject->serial }}</td>
                                <td>
                                    @if ($subject->is_active == 1)
                                    <i class="fa fa-check text-success inline"></i>
                                    @elseif($subject->is_active == 0)
                                    <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm success" href="#" data-toggle="modal"
                                    data-target="#editRecord__{{ $subject->id }}">
                                        <i class="material-icons"></i>
                                    </a>
                                        <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#deleteRecord__{{ $subject->id }}">
                                            <i class="material-icons"></i>
                                        </button>
                                </td>

                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteRecord__{{ $subject->id }}" tabindex="-1"
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
                                            <a href="{{ route('subject.destroy', $subject->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editRecord__{{ $subject->id }}" data-backdrop="static" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('subject.update', $subject->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Subject Name</label>
                                                    <input type="text" name="name"
                                                        value="{{ $subject->name }}"
                                                        placeholder="Enter name" class="form-control">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Subject description</label>
                                                    <textarea name="description" placeholder="Enter subject description" class="form-control">{{$subject->description}}</textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Department</label>
                                                    <select name="department_id" class="form-control">
                                                        <option selected disabled>Select a department</option>
                                                        @foreach($departments as $department)
                                                        <option {{$subject->department_id == $department->id ? 'selected':'' }} value="{{$department->id}}">{{$department->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{$subject->is_active == 1 ? 'selected':''}} value="1">Active</option>
                                                        <option {{$subject->is_active == 0 ? 'selected':''}} value="0">Inactive</option>
                                                    </select>
                                                        @error('status')
                                                        <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Serial number</label>
                                                    <input type="number" name="serial" placeholder="Enter serial number" class="form-control" value="{{$subject->serial}}">
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
                    <h5 class="modal-title" id="exampleModalLabel">Create Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <form action="{{ route('subject.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Enter department name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Subject Description</label>
                            <textarea name="description" placeholder="Enter subject description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Department <span class="text-danger">*</span></label>
                            <select name="department_id" class="form-control">
                                <option selected disabled>Select a department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            @error('department_id')
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
