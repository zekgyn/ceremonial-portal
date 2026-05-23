<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'event_id'          => ['required', 'exists:events,id'],
            'vendor_package_id' => ['required', 'exists:vendor_packages,id'],
        ];
    }
}
