<?php

namespace App\Http\Requests;

use App\Models\BreedingHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBreedingHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('breeding_history_create');
    }

    public function rules()
    {
        return [
            'clutch_no' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'lay_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'hatch_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
