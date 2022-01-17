<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserBirdRequest;
use App\Http\Requests\StoreUserBirdRequest;
use App\Http\Requests\UpdateUserBirdRequest;
use App\Models\Specie;
use App\Models\UserBird;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBirdController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_bird_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userBirds = UserBird::with(['specie', 'created_by', 'breeding_history'])->get();
 
        return view('admin.userBirds.index', compact('userBirds'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_bird_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $species = Specie::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userBirds.create', compact('species'));
    }

    public function store(StoreUserBirdRequest $request)
    {
        $userBird = UserBird::create($request->all());

        return redirect()->route('admin.user-birds.index');
    }

    public function edit(UserBird $userBird)
    {
        abort_if(Gate::denies('user_bird_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $species = Specie::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userBird->load('specie', 'created_by');

        return view('admin.userBirds.edit', compact('species', 'userBird'));
    }

    public function update(UpdateUserBirdRequest $request, UserBird $userBird)
    {
        $userBird->update($request->all());

        return redirect()->route('admin.user-birds.index');
    }

    public function show(UserBird $userBird)
    {
        abort_if(Gate::denies('user_bird_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userBird->load('specie', 'created_by', 'maleBirdBreedingPairs', 'femaleBirdBreedingPairs');

        return view('admin.userBirds.show', compact('userBird'));
    }

    public function destroy(UserBird $userBird)
    {
        abort_if(Gate::denies('user_bird_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userBird->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserBirdRequest $request)
    {
        UserBird::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
