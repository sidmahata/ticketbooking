<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()!=null;
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
            'distance'=>['required', 'integer', 'gt:0'],
        ];
    }
}
