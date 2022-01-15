<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBreedingPairRequest;
use App\Http\Requests\StoreBreedingPairRequest;
use App\Http\Requests\UpdateBreedingPairRequest;
use App\Models\BreedingPair;
use App\Models\UserBird;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BreedingPairController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('breeding_pair_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingPairs = BreedingPair::with(['male_bird', 'female_bird', 'created_by'])->get();

        return view('admin.breedingPairs.index', compact('breedingPairs'));
    }

    public function create()
    {
        abort_if(Gate::denies('breeding_pair_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $male_birds = UserBird::pluck('mutation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $female_birds = UserBird::pluck('mutation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.breedingPairs.create', compact('female_birds', 'male_birds'));
    }

    public function store(StoreBreedingPairRequest $request)
    {
        $breedingPair = BreedingPair::create($request->all());

        return redirect()->route('admin.breeding-pairs.index');
    }

    public function edit(BreedingPair $breedingPair)
    {
        abort_if(Gate::denies('breeding_pair_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $male_birds = UserBird::pluck('mutation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $female_birds = UserBird::pluck('mutation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $breedingPair->load('male_bird', 'female_bird', 'created_by');

        return view('admin.breedingPairs.edit', compact('breedingPair', 'female_birds', 'male_birds'));
    }

    public function update(UpdateBreedingPairRequest $request, BreedingPair $breedingPair)
    {
        $breedingPair->update($request->all());

        return redirect()->route('admin.breeding-pairs.index');
    }

    public function show(BreedingPair $breedingPair)
    {
        abort_if(Gate::denies('breeding_pair_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingPair->load('male_bird', 'female_bird', 'created_by');

        return view('admin.breedingPairs.show', compact('breedingPair'));
    }

    public function destroy(BreedingPair $breedingPair)
    {
        abort_if(Gate::denies('breeding_pair_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingPair->delete();

        return back();
    }

    public function massDestroy(MassDestroyBreedingPairRequest $request)
    {
        BreedingPair::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
