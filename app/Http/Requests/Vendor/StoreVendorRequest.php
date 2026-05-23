<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVendorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'business_name' => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'category'      => ['required', Rule::in(['catering', 'venue_decoration', 'entertainment_media'])],
            'location'      => ['required', 'string', 'max:255'],
        ];
    }
}
