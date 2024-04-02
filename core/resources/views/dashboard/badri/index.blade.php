@extends('dashboard.layouts.master')
@section('title', 'Badri Register')
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
                <h3>Badri Register List</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Badri Register</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('badri.create') }}">
                            <i class="material-icons">&#xe02e;</i>
                            New
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row committee-table">
                <div class="col-md-10">
                    <h4>{{$badritype->title_bd}}</h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th style="max-width:150px;">{{ __('SL') }}</th>
                        <th style="max-width:150px;">{{ __('Name') }}</th>
                        <th style="max-width:150px;">{{ __('Phone') }}</th>
                        <th style="max-width:150px;">{{ __('Address') }}</th>
                        <th style="max-width:150px;">{{ __('Register Date') }}</th>
                        <th style="max-width:150px;">{{ __('Rosit No') }}</th>
                        <th style="max-width:150px;">{{ __('status') }}</th>
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($badriRegisters as $badriRegister)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $badriRegister->name }}</td>
                                <td>{{ $badriRegister->phone }}</td>
                                <td>{{ $badriRegister->address }}</td>
                                <td>{{ $badriRegister->register_date }}</td>
                                <td>{{ $badriRegister->rosit_no }}</td>
                                <td data-toggle="modal"
                                data-target="#editstatus__{{ $badriRegister->id }}" style="cursor: pointer;">
                                    @if ($badriRegister->is_active == 1)
                                        <i class="fa fa-check text-success inline"></i>
                                    @elseif($badriRegister->is_active == 0)
                                        <i class="fa fa-times text-danger inline"></i>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm success" href="{{ route('badriRegister.edit', $badriRegister->id) }}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                        data-target="#deleteMember__{{ $badriRegister->id }}">
                                        <i class="material-icons"></i>
                                    </button>
                                </td>

                            </tr>
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteMember__{{ $badriRegister->id }}" tabindex="-1" role="dialog"
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
                                            <a href="{{ route('badriRegister.destroy', $badriRegister->id) }}"
                                                class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editstatus__{{ $badriRegister->id }}" data-backdrop="static"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Badri Register Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('badriRegister.status', $badriRegister->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option {{ $badriRegister->is_active == 1 ? 'selected' : '' }}
                                                            value="1">Active</option>
                                                        <option {{ $badriRegister->is_active == 0 ? 'selected' : '' }}
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
