<?php

namespace App\Http\Requests;

use App\Rules\CheckDigit;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'name' => 'required',
            'id_number' => ['required', new CheckDigit],
            'phone' => 'required|digits:10|starts_with:0',
            'address' => 'required',
            'gender' => 'required',
        ];
    }
}
