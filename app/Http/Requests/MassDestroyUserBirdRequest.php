<?php

namespace App\Http\Requests;

use App\Models\UserBird;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserBirdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_bird_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_birds,id',
        ];
    }
}
