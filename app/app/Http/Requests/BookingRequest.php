<?php

namespace App\Http\Requests;

use App\Enums\BookingEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id'
            ],
            'service_id' => [
                'required',
                'exists:services,id'
            ],
            'note' => [
                'nullable',
                'string',
                'max:400'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99' // Matches decimal(10,2)
            ],
            'start_date' => [
                'required',
                'date',
                'after_or_equal:now',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime('today midnight')) {
                        $fail('The start date cannot be in the past.');
                    }
                }
            ],
            'end_date' => [
                'nullable',
                'date',
                'after:start_date'
            ],
            'status' => [
                'sometimes',
                'integer',
                Rule::in(BookingEnum::values())
            ]
        ];
    }
        public function messages(): array
    {
        return [
            'status.required' => 'Status is required',
            'status.in' => 'Invalid status value',
            'cancellation_reason.required' => 'Cancellation reason is required when cancelling a booking'
        ];
    }
}
