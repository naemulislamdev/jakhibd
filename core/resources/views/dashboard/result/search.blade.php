@extends('dashboard.layouts.master')
@section('title', 'Search')
@section('content')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
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

        /* Responsive table */
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            thead {
                display: none;
            }

            tr {
                border-bottom: 2px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }

            td {
                border-bottom: none;
                display: block;
                text-align: right;
                /* Align text to the right for better readability */
            }

            td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }

        .sheet-heading-box {
            width: 100%;
            display: flex;
            padding: 15px 12px;
            border: 1px solid #000;
        }

        .sheet-heading-box>.logo>img {
            width: 100px;
            padding: 6px;
        }

        .sheet-heading-box>.logo {
            width: 15%;
        }

        .sheet-heading-box>.seet-heading {
            width: 80%;
            text-align: center;
        }

        .sheet-heading-box>.seet-heading>h3 {}

        .sheet-heading-box>.seet-heading>h4 {}

        .sheet-heading-box>.seet-heading>h5 {}
    </style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Search Student Result</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>result</a>
                </small>
            </div>

            <div class="box-body">
                <form action="{{ route('student.result.search') }}" id="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>বিভাগসমূহ <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" id="">
                                    <option selected disabled>বিভাগ নির্বাচন করুন</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>বিষয়সমূহ <span class="text-danger">*</span></label>
                                <select class="form-control" name="subject_id" id="getSubjects">
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>পরিক্ষার সন <span class="text-danger">*</span></label>
                                <select class="form-control" name="year">
                                    <option selected disabled>পরিক্ষার সন নির্বাচন করুন</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>পরিক্ষার ধরন <span class="text-danger">*</span></label>
                                <select class="form-control" name="exam_type">
                                    <option selected disabled>পরিক্ষার ধরন নির্বাচন করুন</option>
                                    @foreach ($examTypes as $examType)
                                        <option value="{{ $examType->exam_type }}">{{ $examType->exam_type }}</option>
                                    @endforeach
                                </select>
                                @error('exam_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>রোল নং <span class="text-danger">*</span></label>
                                <input type="number" name="roll" class="form-control" placeholder="রোল নং">
                                @error('roll')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button class="btn btn-info">সার্চ করুন</button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- <div class="sheet-heading-box">
                    <div class="logo">
                        <img src="{{ asset('assets/default/print-logo.png') }}" alt="">
                    </div>
                    <div class="seet-heading">
                        <h3>জামিয়া আরাবিয়া খদিমুল ইসলাম মাদরাসা</h3>
                        <h4>বাংলাদেশ কওমী মাদরাসা শিক্ষা বোর্ড</h4>
                        <h5>মীরপুর-১৩, ঢাকা-১২১৬, বাংলাদেশ</h5>
                        <h4>পরিক্ষা নিয়ন্ত্রণ বিভাগ</h4>
                        <h3>নম্বরপত্র - ২০২৪</h3>

                    </div>
                </div>
                <div class="table-responsive">
                    <table>

                        <tbody>
                            <tr>
                                <td colspan="3" class="heading-row">শ্রেণি . খুছুছী/তাইসীর</td>
                            </tr>
                            <tr>
                                <td>Roll</td>
                                <td colspan="2">Regi:</td>
                            </tr>
                            <tr>
                                <td style="width:70%;">Student Name</td>
                                <td colspan="2">Date of Birth:</td>
                            </tr>
                            <tr>
                                <td colspan="3">Father Name</td>
                            </tr>
                            <tr>
                                <td colspan="3">Madrasha Name</td>
                            </tr>
                            <tr>
                                <td colspan="3">Markaj Name</td>
                            </tr>
                            <!-- Add more rows as needed -->
                            <tr>
                                <td style="width:20%; text-align:center;">SL</td>
                                <td style="width:50%; text-align:center;">Subject</td>
                                <td style="width:30%; text-align:center;">Number</td>
                            </tr>
                            <tr>
                                <td style="width:20%; text-align:center;">1</td>
                                <td style="width:50%">Quran Mazid</td>
                                <td style="width:30%; text-align:center;">50</td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
            </div>

        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        //GEt all students by department id
        $('#findResult').on('click', function() {
            $.ajax({
                type: 'POST',
                url: "{{ route('student.result.search') }}",
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    // $('#getStudents').html(res);
                }
            });

        });
    </script>
    <script>
        //GEt all subjects by department id
        // $('#department_id').on('change', function() {
        //     var department_id = $(this).val();

        //     $.ajax({
        //         type: "get",
        //         url: "{{ url('/admin/get/subjects') }}/" + department_id,
        //         dataType: 'html',
        //         success: function(res) {
        //             // console.log(res);
        //             $('#getSubjects').html(res);
        //         }
        //     });

        // });
    </script>
@endpush
