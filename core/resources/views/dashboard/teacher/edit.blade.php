@extends('dashboard.layouts.master')
@section('title', 'Teacher')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>Edit Teacher</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>teacher</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('teacher.index') }}">
                            <i class="fa fa-chevron-left"></i>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <form action="{{ route('teacher.update',$teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>আসাতিযায়ে কেরামের নাম <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter student name"
                                    value="{{ $teacher->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>আসাতিযায়ে কেরামের পদবি <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="Enter teacher title"
                                    value="{{ $teacher->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>নিয়োগ তারিখ <span class="text-danger">*</span></label>
                                <input type="date" name="appointment_date" class="form-control" value="{{ $teacher->appointment_date }}">
                                @error('appointment_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>মোবাইল <span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter teacher phone"
                                    value="{{ $teacher->phone }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>রক্তের গুরুপ </label>
                                <input type="text" name="blood" class="form-control" placeholder="Enter blood group"
                                    value="{{ $teacher->blood }}">
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
                                    <option selected value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>এনআইডি নং</label>
                                <input type="text" name="teacher_nid" class="form-control" placeholder="Enter teacher nid"
                                    value="{{ $teacher->teacher_nid }}">
                                @error('teacher_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>ই-মেইল</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter teacher email"
                                    value="{{ $teacher->email }}">
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
                                <textarea name="address" class="form-control" placeholder="Enter teacher address" value="{{ old('address') }}">{{$teacher->address}}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> আসাতিযায়ে কেরামের ছবি </label>
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
                                <img id="imagePreview" src="{{asset($teacher->image)}}" alt="Image Preview">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">জমা দিন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
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
