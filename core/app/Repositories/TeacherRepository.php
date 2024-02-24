<?php

namespace App\Repositories;

use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use File;
use Illuminate\Http\Request;

class TeacherRepository extends Repository
{

    public static $path = 'uploads/teacher/';
    public static function model()
    {
        return Teacher::class;
    }

    public static function storeByRequest(TeacherRequest $request)
    {
        $imageFinalName = null;
        if ($request->hasFile('image')) {
            $requestImage = $request->image;
            $imgName = uniqid() . '.' . $requestImage->getClientOriginalExtension();

            $path = self::$path;
            $requestImage->move($path, $imgName); // image move to folder
            $imageFinalName = $path . $imgName; //image path upload on database
        }
        $createTeacher = self::create([
            'name' => $request->name,
            'title' => $request->title,
            'appointment_date' => $request->appointment_date,
            'phone' => $request->phone,
            'blood' => $request->blood,
            'gender' => $request->gender,
            'teacher_nid' => $request->teacher_nid,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $imageFinalName,
        ]);
        return $createTeacher;
    }
    public static function updateByRequest(TeacherRequest $request, $id)
    {
        $teacher = self::query()->where('id', $id)->first();
        $imageFinalName = null;
        if ($request->hasFile('image')) {
            File::delete($teacher->image);
            $requestImage = $request->image;
            $imgName = uniqid() . '.' . $requestImage->getClientOriginalExtension();

            $path = self::$path;
            $requestImage->move($path, $imgName); // image move to folder
            $imageFinalName = $path . $imgName; //image path upload on database
        }
        $updateTeacher = self::update($teacher, [
            'name' => $request->name,
            'title' => $request->title,
            'appointment_date' => $request->appointment_date,
            'phone' => $request->phone,
            'blood' => $request->blood,
            'gender' => $request->gender,
            'teacher_nid' => $request->teacher_nid,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $imageFinalName,
        ]);
        return $updateTeacher;
    }
}
