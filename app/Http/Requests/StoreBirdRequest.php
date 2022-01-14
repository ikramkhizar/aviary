<?php

namespace App\Http\Requests;

use App\Models\Bird;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBirdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bird_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
