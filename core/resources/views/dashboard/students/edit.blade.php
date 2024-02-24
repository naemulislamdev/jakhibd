@extends('dashboard.layouts.master')
@section('title', 'Student')
@section('content')
<style>
   #imagePreview {
    width: 100px;
}
</style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Edit Student</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>student</a>
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
                <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>বিভাগ <span class="text-danger">*</span></label>
                                <select class="form-control" name="department_id" id="departmentId">
                                    <option selected disabled>Select a department</option>
                                    @foreach ($departments as $department)
                                        <option {{ $student->department_id == $department->id ? 'selected' : '' }}
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>Sub Department<span class="text-danger">*</span></label>
                                <select class="form-control" name="sub_department_id" id="sub_department">

                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>নাম <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter student name"
                                    value="{{ $student->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>রোল নং <span class="text-danger">*</span></label>
                                <input type="number" name="roll" class="form-control" placeholder="Enter student roll"
                                    value="{{ $student->roll }}">
                                @error('roll')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>ছাত্র এনআইডি <span class="text-danger">*</span></label>
                                <input type="number" name="student_nid" class="form-control" placeholder="Enter student nid" value="{{ $student->student_nid}}">
                                @error('student_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>জন্ম নিবন্ধন নং <span class="text-danger">*</span></label>
                                <input type="number" name="birth_reg_no" class="form-control"
                                    placeholder="Enter birth registration no" value="{{ $student->birth_reg_no }}">
                                @error('birth_reg_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>জন্ম তারিখ <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" class="form-control"
                                    placeholder="Enter date of birth no" value="{{ $student->date_of_birth }}">
                                @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label>রক্তের গুরুপ <span class="text-danger">*</span></label>
                                <input type="text" name="blood" class="form-control" placeholder="Enter blood group"
                                    value="{{ $student->blood }}">
                                @error('blood')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>জেন্ডার <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control">
                                    <option {{ $student->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                                    <option {{ $student->gender == 'female' ? 'selected' : '' }} value="female">Female
                                    </option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>মোবাইল <span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control"
                                    placeholder="Enter student phone" value="{{ $student->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>ই-মেইল </label>
                                <input type="email" name="email" id="" class="form-control"
                                    placeholder="Enter email" value="{{ $student->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label>ঠিকানা <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Enter student address">{{ $student->address }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>অভিভাবক তথ্য</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>পিতার নাম</label>
                                <input type="text" name="father_name" class="form-control"
                                    placeholder="Enter father name" value="{{ $student->father_name }}">
                                @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>পিতার মোবাইল </label>
                                <input type="number" name="father_phone" class="form-control"
                                    placeholder="Enter father phone" value="{{ $student->father_phone }}">
                                @error('father_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>পিতার এনআইডি</label>
                                <input type="number" name="father_nid" class="form-control"
                                    placeholder="Enter father nid" value="{{ $student->father_nid }}">
                                @error('father_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>তালিমুল মুরুব্বি নাম <span class="text-danger">*</span></label>
                                <input type="text" name="talimul_name" class="form-control"
                                    placeholder="Enter talimul murubbi name" value="{{ $student->talimul_name}}">
                                @error('talimul_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>তালিমুল মুরুব্বি মোবাইল <span class="text-danger">*</span></label>
                                <input type="number" name="talimul_phone" class="form-control"
                                    placeholder="Enter talimul murubbi phone" value="{{ $student->talimul_phone}}">
                                @error('talimul_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>তালিমুল মুরুব্বি এনআইডি <span class="text-danger">*</span></label>
                                <input type="number" name="talimul_nid" class="form-control"
                                    placeholder="Enter talimul murubbi nid" value="{{ $student->talimul_nid}}">
                                @error('talimul_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>অনুপস্থিত অভিভাবক তথ্য</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>নাম </label>
                                <input type="text" name="absent_guardian" class="form-control"
                                    placeholder="Enter name" value="{{ $student->absent_guardian }}">
                                @error('absent_guardian')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>মোবাইল </label>
                                <input type="number" name="absent_guardian_phone" class="form-control"
                                    placeholder="Enter phone" value="{{ $student->absent_guardian_phone }}">
                                @error('absent_guardian_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label> এনআইডি </label>
                                <input type="number" name="absent_guardian_nid" class="form-control"
                                    placeholder="Enter nid" value="{{ $student->absent_guardian_nid }}">
                                @error('absent_guardian_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> ছাত্রের ছবি </label>
                                <input type="file" name="image" id="imageInput" class="form-control"
                                    accept=".jpg, .jpeg, .png">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> পূর্বরূপ ছবি </label>
                                <img id="imagePreview" src="{{asset($student->image)}}" alt="Image Preview">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
    <script>
        $('#departmentId').on('change', function() {
            var department_id = $(this).val();

            $.ajax({
                type: "get",
                url: "{{ url('/admin/get/sub-department') }}/" + department_id,
                dataType: 'html',
                success: function(res) {
                    // console.log(res);
                    $('#sub_department').html(res);
                }
            });

        });
    </script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Attach event listener to the file input
        var imageInput = document.getElementById('imageInput');
        imageInput.addEventListener('change', previewImage);
    </script>
@endpush
