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
                <form action="{{ route('get.student.log') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>বিভাগসমূহ <span class="text-danger">*</span></label>
                                <select class="form-control" name="department" id="department_id">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>পরিক্ষার সন <span class="text-danger">*</span></label>
                                <select class="form-control" name="year" id="year">
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
                            <label></label>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">সার্চ করুন</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%" id="dataTable">
                        <thead class="dker">
                            <th style="max-width:50px;">{{ __('SL') }}</th>
                            <th style="max-width:250px;">{{ __('Name') }}</th>
                            <th style="max-width:250px;">{{ __('Department') }}</th>
                            <th style="max-width:250px;">{{ __('Roll') }}</th>
                            <th style="max-width:150px;">{{ __('Year') }}</th>
                            <th style="max-width:150px;">{{ __('Total Marks') }}</th>
                            <th style="max-width:150px;">{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($studentLogs as $studentLog)
                            @php
                                    $studentMark = \App\Models\Result::where('department_id', $studentLog->department_id)
                                        ->where('student_id', $studentLog->student_id)
                                        ->sum('mark');
                                    // $check = $studentLog->year == date('Y');
                                @endphp
                                <tr role="row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $studentLog->student->name }}</td>
                                    <td>{{ $studentLog->department->name }}</td>
                                    <td>{{ $studentLog->roll }}</td>
                                    <td>{{ $studentLog->year }}</td>
                                    <td>{{ $studentMark }}</td>
                                    <td>
                                        <a class="btn btn-sm info" href="{{ route('student.log.show',$studentLog->id)}}">
                                            <i class="material-icons"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endsection
    @push('after-scripts')
        <script>
            //GEt all subjects by department id
            $('#department_id', '#year').on('change', function() {
                var department_id = $('#department_id').val();
                var year = $('#year').val();
                console.log(department_id, year);

                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/get/student/log') }}/" + department_id,
                    dataType: 'html',
                    success: function(res) {
                        // console.log(res);
                        // $('#getSubjects').html(res);
                    }
                });

            });
        </script>
    @endpush
