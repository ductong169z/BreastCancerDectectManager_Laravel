<?php

namespace App\Http\Requests;

use App\Patient;
use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the Patient is authorized to make this request.
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
            'name' => 'required',
            'id_number' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ];
    }
}
