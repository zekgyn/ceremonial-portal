<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'    => ['required', 'string', 'max:255'],
            'type'     => ['required', 'string', 'max:100'],
            'date'     => ['required', 'date', 'after:today'],
            'location' => ['required', 'string', 'max:255'],
            'budget'   => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
