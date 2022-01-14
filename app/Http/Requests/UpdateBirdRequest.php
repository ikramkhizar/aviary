<?php

namespace App\Http\Requests;

use App\Models\Bird;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBirdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bird_edit');
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
