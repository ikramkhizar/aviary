<?php

namespace App\Http\Requests;

use App\Models\BreedingPair;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBreedingPairRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('breeding_pair_create');
    }

    public function rules()
    {
        return [
            'male_bird_id' => [
                'required',
                'integer',
            ],
            'female_bird_id' => [
                'required',
                'integer',
            ],
            'cage_no' => [
                'required',
                'integer',
            ],
        ];
    }
}
