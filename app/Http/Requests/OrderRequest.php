<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|integer',
            'event_date' => 'required|string',
            'ticket_adult_price' => 'required|integer',
            'ticket_adult_quantity' => 'required|integer',
            'ticket_kid_price' => 'required|integer',
            'ticket_kid_quantity' => 'required|integer',
        ];
    }
}
