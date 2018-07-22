<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   => 'required|max:255',
            'content' => '',

        ];
    }

    public function all()
    {
        $all = parent::all();
        $all = array_merge(['son' => 2], $all);

        return $all;

    }
}
