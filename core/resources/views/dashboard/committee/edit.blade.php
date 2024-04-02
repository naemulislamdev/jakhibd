@extends('dashboard.layouts.master')
@section('title', 'Committee')
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Edit Committee</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Committee</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{route('committee.index',$committee->committee_type_id)}}">
                            <i class="fa fa-chevron-left"></i>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <form action="{{ route('committee.update',$committee->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Committee Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="committee_type">
                                    <option selected disabled>Select committee type</option>
                                    @foreach ($committeeTypes as $type)
                                        <option {{$committee->committee_type_id == $type->id ? 'selected':'' }} value="{{ $type->id }}"> {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{$committee->name}}" class="form-control" placeholder="Enter Committee name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{$committee->title}}" class="form-control" placeholder="Enter Committee title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="number" name="phone" value="{{$committee->phone}}" class="form-control" placeholder="Enter Committee phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Serial no <span class="text-danger">*</span></label>
                                <input type="number" name="serial" value="{{$committee->serial}}" class="form-control" placeholder="Enter serial no">
                                @error('serial')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Enter Committee address">{{$committee->address}}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Update</button>
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
