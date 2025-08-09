<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => 'required|string',
            'image_url' => 'nullable|url',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required',
        ];
    }
      /**
     * Get custom validation error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The service name is required.',
            'name.string' => 'The service name must be a valid text.',
            'image_url.url' => 'Please provide a valid URL for the image.',
            'description.required' => 'The service description is required.',
            'description.string' => 'The description must be a valid text.',
            'price.required' => 'The service price is required.',
            'price.numeric' => 'The price must be a valid number.',
            'status.required' => 'The service status is required.',
        ];
    }
}