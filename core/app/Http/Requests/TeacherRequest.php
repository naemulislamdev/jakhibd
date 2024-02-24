<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'appointment_date' => 'required',
            'phone' => 'required|min:11|max:11',
            'blood' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'teacher_nid' => 'nullable|min:10',
            'email' => 'nullable|email',
            'address' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ];
    }
}
