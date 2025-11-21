<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpsertRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'brand_name'   => ['required','string','max:120'],
            'store_name'   => ['required','string','max:120'],
            'address_line1'=> ['nullable','string','max:200'],
            'address_line2'=> ['nullable','string','max:200'],
            'city'         => ['nullable','string','max:120'],
            'state'        => ['nullable','string','max:120'],
            'country'      => ['nullable','string','max:120'],
            'postal_code'  => ['nullable','string','max:20'],
            'lat'          => ['nullable','numeric','between:-90,90'],
            'lng'          => ['nullable','numeric','between:-180,180'],
            'timezone'     => ['required','string','max:64'],
            'status'       => ['required','in:active,inactive'],
            'place_id'     => ['nullable','string','max:255'],
        ];
    }
}
