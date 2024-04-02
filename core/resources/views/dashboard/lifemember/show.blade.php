@extends('dashboard.layouts.master')
@section('title', 'Details')
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
                <h3>Life Member Details</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>member</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('lifeMember.index') }}">
                            <i class="fa fa-chevron-left"></i>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="row mt-3">
                    <b class="col-sm-3">নাম</b>
                    <b class="col-sm-8">{{ $lifeMember->name }}</b>
                    <b class="col-sm-3">পিতার নাম</b>
                    <b class="col-sm-8">{{ $lifeMember->father_name ?? 'N/A' }}</b>
                    <b class="col-sm-3">পেশা</b>
                    <b class="col-sm-8">{{ $lifeMember->designation ?? 'N/A' }}</b>
                    <b class="col-sm-3">বয়স</b>
                    <b class="col-sm-8">{{ $lifeMember->years }}</b>
                    <b class="col-sm-3">মোবাইল</b>
                    <b class="col-sm-8">{{ $lifeMember->phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">ঠিকানা</b>
                    <b class="col-sm-8">{{ $lifeMember->address ?? 'N/A' }}</b>
                    <b class="col-sm-3">দানের ধরন</b>
                    <b class="col-sm-8">{{ $lifeMember->donate_type ?? 'N/A' }}</b>
                    <b class="col-sm-3">দানের পরিমান</b>
                    <b class="col-sm-8">{{ $lifeMember->donate_amount }}</b>
                    <b class="col-sm-3">রেফারেন্স</b>
                    <b class="col-sm-8">{{ $lifeMember->refarence ?? 'N/A' }}</b>

                </div>
            </div>
        </div>
    </div>
@endsection
