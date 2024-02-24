<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $studentNid = 'required';
        if(request()->student_nid !=null){
            $studentNid = 'nullable';
        }
        elseif(request()->birth_reg_no !=null){
            $studentNid = 'nullable';
        }
        return [
            'name' => 'required|string|max:150',
            'email' => 'nullable|email',
            'roll' => 'required',
            'student_nid' => $studentNid,
            'birth_reg_no' => $studentNid,
            'date_of_birth' => 'required',
            'department_id' => 'required',
            // 'sub_department_id' => 'required',
            'gender' => 'required|in:male,female,others',
            'blood' => 'required|string',
            'phone' => 'nullable|min:11|max:11',
            'address' => 'required|string',
            'image' => 'nullable|mimes:jpg, jpeg, png',
            //Guardian Information
            'father_name' => 'nullable|string|max:150',
            'father_phone' => 'nullable|max:11|min:11',
            'father_nid' => 'nullable|integer',
            'talimul_name' => 'required|string|max:150',
            'talimul_phone' => 'required|max:11|min:11',
            'talimul_nid' => 'required|integer',
             //Absent Guardian Information
            'absent_guardian' => 'nullable|string|max:150',
            'absent_guardian_nid' => 'nullable|integer',
            'absent_guardian_phone' => 'nullable|max:11|min:11',
        ];
    }
}
