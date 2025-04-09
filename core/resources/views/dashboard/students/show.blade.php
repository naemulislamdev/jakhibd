@extends('dashboard.layouts.master')
@section('title', 'Student')
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
                <h3>Student Details</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Student</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('student.index') }}">
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
                            <img src="@if (!empty($student->image)) {{ asset($student->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <b class="col-sm-3">বিভাগ</b>
                    <b class="col-sm-8">{{ $student->department->name }}</b>
                    <b class="col-sm-3">সিট নং</b>
                    <b class="col-sm-8">{{ $student->reg ?? 'N/A' }}</b>
                    <b class="col-sm-3">ছাত্রের নাম</b>
                    <b class="col-sm-8">{{ $student->name }}</b>
                    <b class="col-sm-3">রোল নং</b>
                    <b class="col-sm-8">{{ $student->roll ?? 'N/A' }}</b>
                    <b class="col-sm-3">মোবাইল</b>
                    <b class="col-sm-8">{{ $student->phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">ভর্তির টাকা</b>
                    <b class="col-sm-8">{{ $student->deposit ?? '0' }} টাকা</b>
                    <b class="col-sm-3">জাতীয় পরিচয় ধরন</b>
                    <b class="col-sm-8">{{ $student->nid_type == 'nid'? এনআইডি : 'জন্মনিবন্ধন' }}</b>
                    <b class="col-sm-3">জাতীয় পরিচয়/জন্মনিবন্ধন</b>
                    <b class="col-sm-8">{{ $student->nid_number ?? 'N/A' }}</b>
                    <b class="col-sm-3">জন্ম তারিখ</b>
                    <b class="col-sm-8">{{ $student->date_of_birth }}</b>
                    <b class="col-sm-3">ছাত্রের ধরন</b>
                    <b class="col-sm-8">{{ $student->student_type }}</b>
                    <b class="col-sm-3">ভর্তির তারিখ</b>
                    <b class="col-sm-8">{{ $student->admision_date ?? 'N/A' }}</b>
                    <b class="col-sm-3">জেন্ডার</b>
                    <b class="col-sm-8">
                        @if ($student->gender == 'male')
                        মেইল
                        @elseif($student->gender == 'female')
                        ফিমেইল
                        @else
                            Others
                        @endif
                    </b>
                    <b class="col-sm-3">রক্তের গুরুপ</b>
                    <b class="col-sm-8">{{ $student->blood }}</b>
                    <b class="col-sm-3">ই-মেইল</b>
                    <b class="col-sm-8">{{ $student->email ?? 'N/A' }}</b>
                    <b class="col-sm-3">ঠিকানা</b>
                    <b class="col-sm-8">{{ $student->address }}</b>
                    <div class="col-sm-12">
                        <h4 class="my-3" style="color: #2fbe04; margin-top:10px;">অভিভাবক তথ্য :</h4>
                    </div>
                    <b class="col-sm-3">পিতার নাম</b>
                    <b class="col-sm-8">{{ $student->father_name ?? 'N/A' }}</b>
                    <b class="col-sm-3">পিতার মোবাইল</b>
                    <b class="col-sm-8">{{ $student->father_phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">পিতার এনআইডি</b>
                    <b class="col-sm-8">{{ $student->father_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি নাম</b>
                    <b class="col-sm-8">{{ $student->talimul_name ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি মোবাইল</b>
                    <b class="col-sm-8">{{ $student->talimul_phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি এনআইডি</b>
                    <b class="col-sm-8">{{ $student->talimul_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক নাম</b>
                    <b class="col-sm-8">{{ $student->absent_guardian ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক এনআইডি</b>
                    <b class="col-sm-8">{{ $student->absent_guardian_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক মোবাইল</b>
                    <b class="col-sm-8">{{ $student->absent_guardian_phone ?? 'N/A' }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection
