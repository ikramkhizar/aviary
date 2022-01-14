<?php

namespace App\Http\Requests;

use App\Models\BreedingHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBreedingHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('breeding_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:breeding_histories,id',
        ];
    }
}
