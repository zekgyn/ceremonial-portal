<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'    => ['sometimes', 'required', 'string', 'max:255'],
            'type'     => ['sometimes', 'required', 'string', 'max:100'],
            'date'     => ['sometimes', 'required', 'date'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
            'budget'   => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
