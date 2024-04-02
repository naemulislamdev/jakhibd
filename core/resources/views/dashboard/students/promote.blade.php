@extends('dashboard.layouts.master')
@section('title', 'Student')
@section('content')
    <style>
        .custom-width {
            width: 100%;
        }

        .custom-width>button,
        .dropdown-menu {
            width: 100%;
        }

        .box-tool {
            width: 30%;
        }

        .button-box {
            padding: 12px 0px;
            margin: 0px 37px;
        }
    </style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Student List</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>Student</a>
                </small>
            </div>
            <div class="box-tool">
                <div class="dropdown custom-width">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                            $departmentName = \App\Models\Department::where('id', request()->department)->first();
                        @endphp
                        {{ $departmentName->name ?? 'বিভাগ নির্বাচন করুন' }}

                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('student.promote') }}">বিভাগসমূহ</a>
                        @foreach ($departments as $department)
                            <a class="dropdown-item"
                                href="{{ route('student.promote', ['department' => $department->id]) }}">{{ $department->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ route('student.pormote.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%" id="">
                        <thead class="dker">
                            <th><span id="selectAll">{{ __('Select All') }}</span></th>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Prev Roll') }}</th>
                            <th>{{ __('Next Roll') }}</th>
                            <th>{{ __('Promote') }}</th>
                            <th>{{ __('Year') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                @php
                                    $studentLog = \App\Repositories\StudentLogRepository::query()
                                        ->where('student_id', $student->id)
                                        ->where('year', date('Y'))
                                        ->first();
                                    // $check = $studentLog->year == date('Y');
                                @endphp
                                {{-- @dd($student->id) --}}
                                <tr role="row">
                                    <td>
                                        <input type="checkbox" class="checkbox" name="student_id[]"
                                            value="{{ $student->id }}">

                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="@if ($student->image) {{ asset($student->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                            style="width: 50px; height:60px;">
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->department->name }}</td>
                                    <td>
                                        <input type="number" name="prev_roll" class="form-control"
                                            value="{{ $student->roll }}" style="">
                                    </td>
                                    <td>
                                        <input type="number" name="next_roll[]" class="form-control" style="">
                                    </td>
                                    <td>
                                        <select class="form-control" name="department_id[]" style="">
                                            <option selected disabled>বিভাগ নির্বাচন করুন</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="session_year[]" id="" class="form-control">
                                            <option selected disabled>সেশনের বছর</option>
                                            <option value="{{date('Y')}}"> {{date('Y')}}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row button-box">
                    <div class="col-md-12">
                        <button class="btn btn-info">Promote</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        $(document).ready(function() {
            $("#selectAll").click(function() {
                $(".checkbox").prop("checked", true);
            });
        });
    </script>
@endpush
