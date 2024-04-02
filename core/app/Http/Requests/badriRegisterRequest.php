<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class badriRegisterRequest extends FormRequest
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
            'badri_type_id' => 'required',
            'name' => 'required|string',
            'phone' => 'required|string|max:11|min:11',
            'register_date' => 'required',
            'rosit_no' => 'required|string',
            'address' => 'required|string',
        ];
    }
}
