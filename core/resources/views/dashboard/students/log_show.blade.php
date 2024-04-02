@extends('dashboard.layouts.master')
@section('title', 'Student Log')
@section('content')
    <style>
        .imageBox>img {
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
         /* Table styles */
         table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #030303;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #030303;
        }

        .heading-row {
            text-align: center;
            color: #000;
            font-size: 20px;
        }
    </style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Previous Student Details</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Student</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('get.student.log') }}">
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
                            <img src="@if (!empty($studentLog->student->image)) {{ asset($studentLog->student->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <b class="col-sm-3">নাম</b>
                    <b class="col-sm-8">{{ $studentLog->student->name }}</b>
                    <b class="col-sm-3">রোল নং</b>
                    <b class="col-sm-8">{{ $studentLog->roll ?? 'N/A' }}</b>
                    <b class="col-sm-3">সিট নং</b>
                    <b class="col-sm-8">{{ $studentLog->reg ?? 'N/A' }}</b>
                    <b class="col-sm-3">বিভাগ</b>
                    <b class="col-sm-8">{{ $studentLog->department->name }}</b>
                    <b class="col-sm-3">মোবাইল</b>
                    <b class="col-sm-8">{{ $studentLog->student->phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">ছাত্র এনআইডি নং</b>
                    <b class="col-sm-8">{{ $studentLog->student->student_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">জন্ম নিবন্ধন নং</b>
                    <b class="col-sm-8">{{ $studentLog->student->birth_reg_no ?? 'N/A' }}</b>
                    <b class="col-sm-3">জন্ম তারিখ</b>
                    <b class="col-sm-8">{{ $studentLog->student->date_of_birth }}</b>
                    <b class="col-sm-3">ভর্তির তারিখ</b>
                    <b class="col-sm-8">{{ $student->admision_date ?? 'N/A' }}</b>
                    <b class="col-sm-3">ধর্ম </b>
                    <b class="col-sm-8">Islam</b>
                    <b class="col-sm-3">জেন্ডার</b>
                    <b class="col-sm-8">
                        @if ($studentLog->student->gender == 'male')
                            Male
                        @elseif($studentLog->student->gender == 'female')
                            Female
                        @else
                            Others
                        @endif
                    </b>
                    <b class="col-sm-3">রক্তের গুরুপ</b>
                    <b class="col-sm-8">{{ $studentLog->student->blood }}</b>
                    <b class="col-sm-3">ই-মেইল</b>
                    <b class="col-sm-8">{{ $studentLog->student->email ?? 'N/A' }}</b>
                    <b class="col-sm-3">ঠিকানা</b>
                    <b class="col-sm-8">{{ $studentLog->student->address }}</b>
                    <div class="col-sm-12">
                        <h4 class="my-3" style="color: #353866; margin-top:10px;">অভিভাবক তথ্য :</h4>
                    </div>
                    <b class="col-sm-3">পিতার নাম</b>
                    <b class="col-sm-8">{{ $studentLog->student->father_name ?? 'N/A' }}</b>
                    <b class="col-sm-3">পিতার মোবাইল</b>
                    <b class="col-sm-8">{{ $studentLog->student->father_phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">পিতার এনআইডি</b>
                    <b class="col-sm-8">{{ $studentLog->student->father_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি নাম</b>
                    <b class="col-sm-8">{{ $studentLog->student->talimul_name ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি মোবাইল</b>
                    <b class="col-sm-8">{{ $studentLog->student->talimul_phone ?? 'N/A' }}</b>
                    <b class="col-sm-3">তালিমুল মুরুব্বি এনআইডি</b>
                    <b class="col-sm-8">{{ $studentLog->student->talimul_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক নাম</b>
                    <b class="col-sm-8">{{ $studentLog->student->absent_guardian ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক এনআইডি</b>
                    <b class="col-sm-8">{{ $studentLog->student->absent_guardian_nid ?? 'N/A' }}</b>
                    <b class="col-sm-3">অনুপস্থিত অভিভাবক মোবাইল</b>
                    <b class="col-sm-8">{{ $studentLog->student->absent_guardian_phone ?? 'N/A' }}</b>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <h4 class="my-3" style="color: #353866; margin-top:10px;">পূর্ববর্তী পরীক্ষার ফলাফল :</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            @php
                            use Rakibhstu\Banglanumber\NumberToBangla;

                            $numto = new NumberToBangla();
                        @endphp
                            @foreach ($examTypes as $examType)
                            {{-- @dd($examType->exam_type) --}}
                                @php
                                    $examTypeWiseSubjects = \App\Models\Result::where('department_id', $studentLog->department_id)
                                        ->where('exam_type', $examType->exam_type)
                                        ->where('student_id', $studentLog->student_id)
                                        ->get();
                                    $examTotalMark = $examTypeWiseSubjects->sum('mark');
                                    // $total_marks = \App\Models\Result::with('student')
                                    //     ->where('department_id', $request->department)
                                    //     ->where('year', $request->year)
                                    //     ->where('exam_type', $request->exam_type)
                                    //     ->where('roll', $request->roll)
                                    //     ->sum('mark');
                                @endphp
                                <tr>
                                    <th colspan="4" style="text-align: center;">{{ $examType->exam_type }}</th>
                                </tr>
                                <tr>
                                    <th style="width:20%; text-align:center;">ক্রমিক নং</th>
                                    <th style="width:45%; text-align:center;">বিষয়</th>
                                    <th style="width:15%; text-align:center;">বিষয় কোড</th>
                                    <th style="width:30%; text-align:center;">প্রাপ্ত নম্বর</th>
                                </tr>

                                @foreach ($examTypeWiseSubjects as $subjectData)
                                    <tr style="width: 100%;">
                                        <td style="width:20%; text-align:center;">{{ $numto->bnNum($loop->index + 1) }}
                                        </td>
                                        <td style="width:45%">{{ $subjectData->subject->name }}</td>
                                        <td style="width:15%; text-align:center;">
                                            {{ $numto->bnNum($subjectData->subject->code) }}</td>
                                        <td style="width:30%; text-align:center;">{{ $numto->bnNum($subjectData->mark) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style=" text-align:right;" colspan="3">মোট প্রাপ্ত নম্বর</th>
                                    <th style="width:50%; text-align:center;">{{$numto->bnNum($examTotalMark)}}</th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
