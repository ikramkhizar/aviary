<?php

namespace App\Http\Requests;

use App\Models\Bird;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBirdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bird_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:birds,id',
        ];
    }
}
