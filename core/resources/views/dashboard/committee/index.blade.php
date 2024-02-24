@extends('dashboard.layouts.master')
@section('title', 'Committee')
@section('content')
    <style>
        .committee-table {
            margin-top: 20px;
            text-align: center;
            background: #2e3e4e;
            padding: 10px 0px;
            margin: 8px 17px;
        }

        .committee-table>div>h4 {
            margin: 0;
            color: #fff;
            font-size: 20px;
        }
        .committee-table>div> a > .fa-pdf {
            color: #fff;
            font-size: 20px;
        }
    </style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Committee List</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Committee</a>
                </small>
                <h3>Committee</h3>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('committee.create') }}">
                            <i class="material-icons">&#xe02e;</i>
                            New
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row committee-table">
                <div class="col-md-10">
                    <h4>{{$type->name}}</h4>
                </div>
                <div class="col-md-2">
                   <a href="{{ route('committee.pdf',$type->id)}}"><i class="fa fa-file-pdf-o fa-pdf" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th style="max-width:150px;">{{ __('SL') }}</th>
                        <th style="max-width:150px;">{{ __('Title') }}</th>
                        <th style="max-width:150px;">{{ __('Name') }}</th>
                        <th style="max-width:150px;">{{ __('Phone') }}</th>
                        <th style="max-width:150px;">{{ __('Address') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($committees as $committee)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $committee->title }}</td>
                                <td>{{ $committee->name }}</td>
                                <td>{{ $committee->phone }}</td>
                                <td>{{ $committee->address }}</td>
                                <td data-toggle="modal"
                                data-target="#editstatus__{{ $committee->id }}" style="cursor: pointer;">
                                    @if ($committee->is_active == 1)
                                        <i class="fa fa-check text-success inline"></i>
                                    @elseif($committee->is_active == 0)
                                        <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm success" href="{{ route('committee.edit', $committee->id) }}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                        data-target="#deleteMember__{{ $committee->id }}">
                                        <i class="material-icons"></i>
                                    </button>
                                </td>

                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $committee->id }}" tabindex="-1" role="dialog"
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
                                            <a href="{{ route('committee.destroy', $committee->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editstatus__{{ $committee->id }}" data-backdrop="static"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Committee Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('committee.status', $committee->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{ $committee->is_active == 1 ? 'selected' : '' }}
                                                            value="1">Active</option>
                                                        <option {{ $committee->is_active == 0 ? 'selected' : '' }}
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
