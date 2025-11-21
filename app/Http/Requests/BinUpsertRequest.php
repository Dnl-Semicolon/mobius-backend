<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BinUpsertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ($this->user()?->role ?? null) === 'SuperAdmin';
    }

    public function rules(): array
    {
        $binId = $this->route('bin')?->id;

        return [
            'store_id' => ['required', 'uuid', 'exists:stores,id'],
            'name' => ['required', 'string', 'max:255'],
            'hardware_identifier' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bins', 'hardware_identifier')->ignore($binId),
            ],
            'location_name' => ['nullable', 'string', 'max:255'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'notes' => ['nullable', 'string'],
        ];
    }
}
