<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommitteeRequest extends FormRequest
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
            'committee_type' => 'required',
            'name'=> 'required|string|max:30',
            'title'=> 'required|string|max:30',
            'phone'=> 'required|min:11|max:11',
            'address'=> 'required|string',
            'serial'=> 'nullable|string',
        ];
    }
}
