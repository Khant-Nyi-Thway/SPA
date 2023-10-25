<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\NotNumericString; // Import your custom validation rule

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can define authorization logic here if needed.
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', new NotNumericString], // Use the custom rule here
            'price' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->messages(),
        ], 400));
    }

    public function messages()
    {
        return [
            'name.required' => 'အမည်ထည့်ရန်လိုအပ်သည်။',
            'name.string' => 'အမည်သည် စာသားဖြစ်ရပါမည်။',
            'price.required' => 'စျေးနှုန်း ထည့်ပါ။',
            'price.numeric' => 'စျေးနှုန်းသည် number ဖြစ်ရပါမည်။',
        ];
    }
}
