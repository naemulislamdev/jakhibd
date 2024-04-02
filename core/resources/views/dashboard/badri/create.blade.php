@extends('dashboard.layouts.master')
@section('title', 'Badri Register')
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Create Badri Register</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>badri register</a>
                </small>
            </div>
            <div class="box-body">
                <form action="{{ route('badri.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Badri Register Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="badri_type_id">
                                    <option selected disabled>Select badri register type</option>
                                    @foreach ($badriRegisterTypes as $type)
                                        <option value="{{ $type->id }}"> {{ $type->title_bd }}</option>
                                    @endforeach
                                </select>
                                @error('badri_type_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name')}}" class="form-control" placeholder="Enter name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone')}}" class="form-control" placeholder="Enter phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Badri Register Date <span class="text-danger">*</span></label>
                                <input type="date" name="register_date" value="{{ old('register_date')}}" class="form-control">
                                @error('register_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Badri Register Rosit No<span class="text-danger">*</span></label>
                                <input type="text" name="rosit_no" value="{{ old('rosit_no')}}" class="form-control">
                                @error('rosit_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Enter address">{{ old('address')}}</textarea>
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
@endpush
