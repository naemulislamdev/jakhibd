<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LifeMemberRequest extends FormRequest
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
            'name' => 'required|string|max:20',
            'father_name' => 'required|string|max:20',
            'designation' => 'required|string|max:20',
            'years' => 'required',
            'phone' => 'required|min:11|max:11',
            'address' => 'required|string|max:200'
        ];
    }
}
