<?php

namespace App\Modules\Estimate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimateValidationRequest extends FormRequest
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
        $rules['order_code'] = ['required'];
        $rules['date'] = ['required', 'date_format:d-m-Y'];
        $rules['model_name.*'] = ['required', 'string'];
        $rules['length.*.*'] = ['required'];
        $rules['quantity.*.*'] = ['required'];
        $rules['requirements'] = ['required', 'string'];
        $rules['note'] = ['required', 'string', 'max:255'];
        $rules['deadline'] = ['required', 'date_format:d-m-Y'];

        return $rules;
    }

    /**
     * set custom messages
     */
    public function messages()
    {
        $message['model_name.*.required'] = 'Model name required!';
        $message['length.*.*.required'] = 'Length required';
        $message['quantity.*.*.required'] = 'Quantity required';

        return $message;
    }
}
