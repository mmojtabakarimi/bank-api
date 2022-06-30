<?php

namespace App\Http\Requests;

use App\Rules\CheckIranBankCard;
use Illuminate\Foundation\Http\FormRequest;

class DoPaymentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'origin_card' => ['required', new CheckIranBankCard()],
            'destination_card' => ['required', new CheckIranBankCard()],
            'payment_value' => 'required |numeric|min:1000|max:50000000'

        ];
    }
}
