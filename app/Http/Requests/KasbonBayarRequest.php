<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KasbonBayarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //'status_r' => ['required', 'string', 'max:255'],  // Setuju / Tolak
            'status_b' => ['required', 'string', 'max:255'],  // Lunas / Belum Lunas

        ];
    }
}
