<?php

namespace App\Http\Requests;

use App\Models\UserBird;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserBirdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_bird_edit');
    }

    public function rules()
    {
        return [
            'mutation_name' => [
                'string',
                'required',
            ],
            'ring_no' => [
                'string',
                'required',
                'unique:user_birds,ring_no,' . request()->route('user_bird')->id,
            ],
            'male_parent' => [
                'string',
                'nullable',
            ],
            'female_parent' => [
                'string',
                'nullable',
            ],
            'cage_no' => [
                'string',
                'nullable',
            ],
            'dob' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
