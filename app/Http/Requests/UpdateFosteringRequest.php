<?php

namespace App\Http\Requests;

use App\Models\Fostering;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFosteringRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fostering_edit');
    }

    public function rules()
    {
        return [
            'foster_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
