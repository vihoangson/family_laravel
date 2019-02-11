<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function authorize()
    {
        return true;
    }
    public function rules() {
        return [
            'question' => ['required','max:255'],
        ];
    }
}