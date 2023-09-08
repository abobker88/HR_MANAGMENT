<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;
class ApplicationRequest extends FormRequest
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
            'name'=>           'required',
             'DOB'             =>'required|date_format:Y-m-d',
             'gender'          =>'required|in:male,female',
             'nationality'     =>'required',
             'cv'              =>'required|mimes:pdf|max:10000',
        ];
    }


    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],422));

    }



    public function messages()

    {

        return [
            'DOB.required'=>'date of birth is required',
        ];

    }
}
