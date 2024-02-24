@extends('dashboard.layouts.master')
@section('title', 'Result')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Create Student Result</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>result</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('student.create') }}">
                            <i class="material-icons">&#xe02e;</i>
                            New
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>বিভাগ <span class="text-danger">*</span></label>
                            <select class="form-control" name="department_id" id="department_id">
                                <option selected disabled>Select a department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Subject<span class="text-danger">*</span></label>
                            <select class="form-control" name="subject_id" id="subjects">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label>Exam type <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label>Year <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name"
                                value="{{ date('Y') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%" id="">
                        <thead class="dker">
                            <th style="max-width:50px;">{{ __('SL') }}</th>
                            <th style="max-width:250px;">{{ __('image') }}</th>
                            <th style="max-width:250px;">{{ __('Name') }}</th>
                            <th style="max-width:250px;">{{ __('Roll') }}</th>
                            <th style="max-width:150px;">{{ __('Mark') }}</th>
                        </thead>
                        <tbody id="getStudents">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        //GEt all students by department id
        $('#department_id').on('change', function() {
            var department_id = $(this).val();

            $.ajax({
                type: "get",
                url: "{{ url('/admin/get/students') }}/" + department_id,
                dataType: 'html',
                success: function(res) {
                    // console.log(res);
                    $('#getStudents').html(res);
                }
            });

        });
    </script>
    <script>
        //GEt all subjects by department id
        $('#department_id').on('change', function() {
            var department_id = $(this).val();

            $.ajax({
                type: "get",
                url: "{{ url('/admin/get/subjects') }}/" + department_id,
                dataType: 'html',
                success: function(res) {
                    // console.log(res);
                    $('#getStudents').html(res);
                }
            });

        });
    </script>
@endpush
