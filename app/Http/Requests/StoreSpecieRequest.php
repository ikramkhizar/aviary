<?php

namespace App\Http\Requests;

use App\Models\Specie;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecieRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specie_create');
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
