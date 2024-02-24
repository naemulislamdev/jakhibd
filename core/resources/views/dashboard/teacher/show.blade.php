@extends('dashboard.layouts.master')
@section('title', 'Teacher')
@section('content')
<style>
   .imageBox >img {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    height: 164px;
    width: 162px;
    border: 3px solid #353866;
    margin-bottom: 20px;
}
b {
    border: 1px solid #d9d9d9 !important;
    padding: 6px;
}
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Teacher Details</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>teacher</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('teacher.index') }}">
                            <i class="fa fa-chevron-left"></i>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="row mb-3">
                    <div class="col-md-12 mx-auto text-center">
                        <div class="imageBox">
                            <img src="@if (!empty($teacher->image)) {{ asset($teacher->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <b class="col-sm-3">আসাতিযায়ে কেরামের নাম</b>
                    <b class="col-sm-8">{{ $teacher->name }}</b>
                    <b class="col-sm-3">আসাতিযায়ে কেরামের পদবি</b>
                    <b class="col-sm-8">{{ $teacher->title ?? 'N/A' }}</b>
                    <b class="col-sm-3">নিয়োগ তারিখ</b>
                    <b class="col-sm-8">{{ $teacher->appointment_date }}</b>
                    <b class="col-sm-3">মোবাইল</b>
                    <b class="col-sm-8">{{ $teacher->phone }}</b>
                    <b class="col-sm-3">এনআইডি নং</b>
                    <b class="col-sm-8">{{ $teacher->teacher_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">জেন্ডার</b>
                    <b class="col-sm-8">
                        @if ($teacher->gender == 'male')
                            Male
                        @elseif($teacher->gender == 'female')
                            Female
                        @else
                            Others
                        @endif
                    </b>
                    <b class="col-sm-3">রক্তের গুরুপ</b>
                    <b class="col-sm-8">{{ $teacher->blood ?? 'N/A' }}</b>
                    <b class="col-sm-3">ই-মেইল</b>
                    <b class="col-sm-8">{{ $teacher->email ?? 'N/A' }}</b>
                    <b class="col-sm-3">ঠিকানা</b>
                    <b class="col-sm-8">{{ $teacher->address }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection
