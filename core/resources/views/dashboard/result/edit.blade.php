@extends('dashboard.layouts.master')
@section('title', 'Result')
@section('content')
<style>
    th,.text-center{text-align: center;}
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Edit Student Result</h3>
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
            <form action="{{ route('student.result.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%" id="">
                            <thead class="dker">
                                <th style="max-width:50px;">{{ __('SL') }}</th>
                                <th style="max-width:250px;">{{ __('image') }}</th>
                                <th style="max-width:250px;">{{ __('Name') }}</th>
                                <th style="max-width:250px;">{{ __('Roll') }}</th>
                                <th style="max-width:250px;">{{ __('Department') }}</th>
                                <th style="max-width:250px;">{{ __('Subject') }}</th>
                                <th style="max-width:150px;">{{ __('Mark') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <input type="hidden" name="result_id[]" value="{{$result->id}}">

                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">
                                            <img src="@if ($result->student->image) {{ asset($result->student->image) }} @else {{ asset('assets/default/no-img.jpg') }} @endif"
                                                style="width: 50px; height:60px;">
                                        </td>
                                        <td>{{ $result->student->name }}</td>
                                        <td class="text-center">{{ $result->student->roll }}</td>
                                        <td>{{ $result->department->name }}</td>
                                        <td>{{ $result->subject->name }}</td>
                                        <td><input type="number" name="mark[]" value="{{ $result->mark }}"
                                                class="form-control" placeholder="Enter mark"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
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
