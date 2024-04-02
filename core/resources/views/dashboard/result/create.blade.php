@extends('dashboard.layouts.master')
@section('title', 'Result')
@section('content')
<style>
    th,.text-center{text-align: center;}
</style>
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
                        <a class="btn btn-fw primary" href="{{ route('student.result.index') }}">
                            <i class="fa fa-chevron-left"></i>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
            <form action="{{ route('student.result.store') }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>বিভাগসমূহ <span class="text-danger">*</span></label>
                                <select class="form-control" name="department_id" id="department_id">
                                    <option selected disabled>বিভাগ নির্বাচন করুন</option>
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
                                <label>বিষয়সমূহ <span class="text-danger">*</span></label>
                                <select class="form-control" name="subject_id" id="getSubjects">
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>পরিক্ষার ধরন <span class="text-danger">*</span></label>
                                <input type="text" name="exam_type" class="form-control" placeholder="Enter exam type"
                                    value="{{ old('exam_type') }}">
                                @error('exam_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label>পরিক্ষার সন <span class="text-danger">*</span></label>
                                <input type="text" name="exam_year" class="form-control" placeholder="Enter exam year"
                                    value="{{ date('Y') }}">
                                @error('exam_year')
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
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
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
                    $('#getSubjects').html(res);
                }
            });

        });
    </script>
@endpush
