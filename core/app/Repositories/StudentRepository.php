<?php

namespace App\Repositories;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use File;
use Illuminate\Support\Facades\Storage;


class StudentRepository extends Repository
{
    public static $path = 'uploads/students/';
    public static function model()
    {
        return Student::class;
    }

    public static function storeByRequest(StudentRequest $request)
    {
        $imageFinalName = null;
        if ($request->hasFile('image')) {
            $requestImage = $request->image;
            // $path = Storage::put('/'.trim(self::$path,'/'), $request->image, 'public');
            $imgName = uniqid() . '.' . $requestImage->getClientOriginalExtension();

            $path = self::$path;
            $requestImage->move($path, $imgName);
            $imageFinalName = $path . $imgName;
        }
        $createStudent =  self::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'roll' => $request->roll,
            'reg' => $request->reg,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'deposit' => $request->deposit,
            'student_type' => $request->student_type,
            'nid_type' => $request->nid_type,
            'nid_number' => $request->nid_number,
            'admision_date' => $request->admision_date,
            'blood' => $request->blood,
            'phone' => $request->phone,
            'email' => $request->email,
            'father_name' => $request->father_name,
            'father_nid' => $request->father_nid,
            'father_phone' => $request->father_phone,
            'talimul_name' => $request->talimul_name,
            'talimul_nid' => $request->talimul_nid,
            'talimul_phone' => $request->talimul_phone,
            'absent_guardian' => $request->absent_guardian,
            'absent_guardian_nid' => $request->absent_guardian_nid,
            'absent_guardian_phone' => $request->absent_guardian_phone,
            'address' => $request->address,
            'image' => $imageFinalName,
            'is_active' => true,
            'session_year'=> date('Y')
        ]);
        return $createStudent;
    }
    public static function updateByRequest(StudentRequest $request, $id)
    {
        $student = self::query()->where('id', $id)->first();
        $imageFinalName = null;
        if ($request->hasFile('image')) {
            File::delete($student->image);
            $requestImage = $request->image;
            // $path = Storage::put('/'.trim(self::$path,'/'), $request->image, 'public');
            $imgName = uniqid() . '.' . $requestImage->getClientOriginalExtension();

            $path = self::$path;
            $requestImage->move($path, $imgName);
            $imageFinalName = $path . $imgName;
        }
        $updateStudent =  self::update($student,[
            'name' => $request->name,
            'department_id' => $request->department_id,
            'roll' => $request->roll,
            'reg' => $request->reg,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'deposit' => $request->deposit,
            'student_type' => $request->student_type,
            'nid_type' => $request->nid_type,
            'nid_number' => $request->nid_number,
            'admision_date' => $request->admision_date,
            'blood' => $request->blood,
            'phone' => $request->phone,
            'email' => $request->email,
            'father_name' => $request->father_name,
            'father_nid' => $request->father_nid,
            'father_phone' => $request->father_phone,
            'talimul_name' => $request->talimul_name,
            'talimul_nid' => $request->talimul_nid,
            'talimul_phone' => $request->talimul_phone,
            'absent_guardian' => $request->absent_guardian,
            'absent_guardian_nid' => $request->absent_guardian_nid,
            'absent_guardian_phone' => $request->absent_guardian_phone,
            'address' => $request->address,
            'image' => $imageFinalName ?? $student->image,
        ]);
        return $updateStudent;
    }
}
