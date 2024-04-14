<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'from_station'=>['required'],
            'to_station'=>['required', function ($attribute, $value, $fail) {
                if ($value === $this->from_station) {
                    $fail($attribute.' cannot be same as from station.');
                }
            },],
            'client_name'=>['required'],
        ];
    }
    public function messages()
    {
        return [
            'client_name.required' => 'Your name is required.',
        ];
    }
}
