<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
        $department = 'required';
        $subject = 'required';
        $examType = 'required|string';
        $examYear = 'required|string';
        if (request()->isMethod('put')) {
            $department = 'nullable';
            $subject = 'nullable';
            $examType = 'nullable|string';
            $examYear = 'nullable|string';
        }
        return [
            'department_id' => $department,
            'subject_id' => $subject,
            'exam_type' => $examType,
            'exam_year' => $examYear,
            'mark.*' => 'required'
        ];
    }
}
