<?php

namespace App\Http\Requests;

use App\Models\Egg;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEggRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('egg_edit');
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
