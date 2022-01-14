<?php

namespace App\Http\Requests;

use App\Models\Specie;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecieRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specie_edit');
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
