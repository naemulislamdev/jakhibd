@extends('dashboard.layouts.master')
@section('title', 'Life Member')
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Life Member</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Life member</a>
                </small>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th class="text-center" style="max-width:150px;">{{ __('SL') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Name') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Father Name') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Years') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Designation') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Phone') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Address') }}</th>
                        <th class="text-center" style="max-width:150px;">{{ __('Options') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($lifeMembers as $lifeMember)
                            <tr role="row">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td class="sorting_1">
                                    <div class="h6">{{ $lifeMember->name }}</div>
                                </td>
                                <td>
                                    <div class="text-center">{{ $lifeMember->father_name }}</div>
                                </td>
                                <td>
                                    <div class="text-center">{{ $lifeMember->years }}</div>
                                </td>
                                <td>
                                    <div class="text-center">{{ $lifeMember->designation }}</div>
                                </td>
                                <td>
                                    <div class="text-center">{{ $lifeMember->phone }}</div>
                                </td>
                                <td>
                                    <div class="text-center">{{ $lifeMember->address }}</div>
                                </td>
                                <td>
                                    <a class="btn btn-sm info" href="{{ route('lifeMember.show', $lifeMember->id) }}">
                                        <i class="material-icons"></i>
                                    </a>
                                        <button type="button" class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#deleteMember__{{ $lifeMember->id }}">
                                            <i class="material-icons"></i>
                                        </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteMember__{{ $lifeMember->id }}" tabindex="-1"
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
                                                    <a href="{{ route('lifeMember.destroy',$lifeMember->id)}}" class="btn btn-primary">Yes</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('after-scripts')
    <script src="{{ URL::asset('assets/frontend/js/Chart.min.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/datatables.min.js') }}"></script>
@endpush
