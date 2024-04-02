@extends('dashboard.layouts.master')
@section('title', 'Result')
@section('content')
    <div class="padding">

        <div class="box">
            <div class="box-header dker">
                <h3>Result List</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>result</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('student.result.create')}}">
                            <i class="material-icons">&#xe02e;</i>
                            New
                        </a>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%" id="dataTable">
                    <thead class="dker">
                        <th style="max-width:50px;">{{ __('SL') }}</th>
                        <th style="max-width:250px;">{{ __('Department') }}</th>
                        <th style="max-width:250px;">{{ __('Subject Name') }}</th>
                        <th style="max-width:250px;">{{ __('Exam Type') }}</th>
                        {{-- <th style="max-width:150px;">{{ __('Totla Student') }}</th> --}}
                        <th style="max-width:150px;">{{ __('Action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr role="row">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->department->name }}</td>
                                <td>{{ $result->subject->name }}</td>
                                <td>{{ $result->exam_type }}</td>
                                {{-- <td>{{ $totalStudents}}</td> --}}
                                <td>
                                    <a class="btn btn-sm success" href="{{ route('student.result.edit',[
                                        'department'=> $result->department_id,
                                        'subject'=> $result->subject_id,
                                        'exam'=> $result->exam_type
                                        ])}}">
                                        <i class="material-icons"></i>
                                    </a>
                                    <a class="btn btn-sm danger" href="{{ route('student.result.destroy',[
                                        'department'=> $result->department_id,
                                        'subject'=> $result->subject_id,
                                        'exam'=> $result->exam_type
                                        ])}}">
                                        <i class="material-icons"></i>
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
