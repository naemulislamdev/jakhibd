@extends('dashboard.layouts.master')
@section('title', 'Committee Type')
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                    <h3>Committee Type List</h3>
                    <small>
                        <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                        <a>Committee Type</a>
                    </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                        <li class="nav-item inline">
                            <a class="btn btn-fw primary" href="#" data-toggle="modal" data-target="#addCommitteeType">
                                <i class="material-icons">&#xe02e;</i>
                                New
                            </a>
                        </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th style="max-width:150px;">{{ __('SL') }}</th>
                        <th style="max-width:150px;">{{ __('Name') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($committeeTypes as $committeeType)
                            <tr role="row">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="sorting_1">
                                    <div class="h6">{{ $committeeType->name }}</div>
                                </td>
                                <td>
                                    @if ($committeeType->is_active == 1)
                                    <i class="fa fa-check text-success inline"></i>
                                    @elseif($committeeType->is_active == 0)
                                    <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm success" href="#" data-toggle="modal"
                                    data-target="#editcommitteeType__{{ $committeeType->id }}">
                                        <i class="material-icons"></i>
                                    </a>
                                        <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#deleteMember__{{ $committeeType->id }}">
                                            <i class="material-icons"></i>
                                        </button>
                                </td>
                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $committeeType->id }}" tabindex="-1"
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
                                            <a href="{{ route('committeeType.destroy', $committeeType->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editcommitteeType__{{ $committeeType->id }}" data-backdrop="static" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Committee Type</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('committeeType.update', $committeeType->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" name="name"
                                                        value="{{ $committeeType->name }}"
                                                        placeholder="Enter name" class="form-control">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message}}</span>
                                                        @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{$committeeType->is_active == 1 ? 'selected':''}} value="1">Active</option>
                                                        <option {{$committeeType->is_active == 0 ? 'selected':''}} value="0">Inactive</option>
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
    <div class="modal fade" id="addCommitteeType" tabindex="-1" data-backdrop="static" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Committee Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <form action="{{ route('committeeType.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                            @error('name')
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
@push('after-scripts')
    <script src="{{ URL::asset('assets/frontend/js/Chart.min.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/datatables.min.js') }}"></script>
@endpush
