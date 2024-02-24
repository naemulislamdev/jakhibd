@extends('dashboard.layouts.master')
@section('title', 'Teacher')
@section('content')
<style>
    .acction-btn{margin-bottom: 5px;}
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                    <h3>Teacher List</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                        <a>teacher</a>
                    </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                        <li class="nav-item inline">
                            <a class="btn btn-fw primary" href="{{route('teacher.create')}}">
                                <i class="material-icons">&#xe02e;</i>
                                New
                            </a>
                        </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@if($teacher->image) {{asset($teacher->image)}} @else {{ asset('assets/default/no-img.jpg')}} @endif" style="width: 50px; height:60px;">
                                </td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->title }}</td>
                                <td>{{ $teacher->address }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td style="cursor: pointer;" data-toggle="modal"
                                data-target="#editRecord__{{ $teacher->id }}">
                                    @if ($teacher->is_active == 1)
                                    <i class="fa fa-check text-success inline"></i>
                                    @elseif($teacher->is_active == 0)
                                    <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td class="text-center d-flex">
                                    <a class="btn btn-sm info acction-btn" href="{{ route('teacher.show',$teacher->id)}}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <a class="btn btn-sm success acction-btn" href="{{ route('teacher.edit',$teacher->id)}}">
                                        <i class="material-icons"></i>
                                    </a>
                                        <button type="button" class="btn btn-sm warning acction-btn" data-toggle="modal"
                                            data-target="#deleteMember__{{ $teacher->id }}">
                                            <i class="material-icons"></i>
                                        </button>
                                </td>
                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $teacher->id }}" tabindex="-1"
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
                                            <a href="{{ route('teacher.destroy', $teacher->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editRecord__{{ $teacher->id }}" data-backdrop="static" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('teacher.status', $teacher->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{$teacher->is_active == 1 ? 'selected':''}} value="1">Active</option>
                                                        <option {{$teacher->is_active == 0 ? 'selected':''}} value="0">Inactive</option>
                                                    </select>
                                                        @error('status')
                                                        <span class="text-danger">{{ $message}}</span>
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
