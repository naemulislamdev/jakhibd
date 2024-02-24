@extends('dashboard.layouts.master')
@section('title', 'Committee')
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Create Committee</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Committee</a>
                </small>
            </div>
            <div class="box-body">
                <form action="{{ route('committee.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Committee Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="committee_type">
                                    <option selected disabled>Select committee type</option>
                                    @foreach ($committeeTypes as $type)
                                        <option value="{{ $type->id }}"> {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Enter Committee name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="" class="form-control" placeholder="Enter Committee title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="number" name="phone" id="" class="form-control" placeholder="Enter Committee phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Enter Committee address"></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
