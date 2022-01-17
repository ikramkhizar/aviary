<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBreedingHistoryRequest;
use App\Http\Requests\StoreBreedingHistoryRequest;
use App\Http\Requests\UpdateBreedingHistoryRequest;
use App\Models\UserBird;
use App\Models\BreedingPair;
use App\Models\BreedingHistory;
use App\Models\Specie;
use App\Models\Egg;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BreedingHistoryController extends Controller
{
    public function index(BreedingPair $breedingPair)
    {
        abort_if(Gate::denies('breeding_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingHistories = BreedingHistory::with(['egg_type', 'created_by'])->get();

        return view('admin.breedingHistories.index', compact('breedingHistories','breedingPair'));
    }

    public function create(BreedingPair $breedingPair)
    {
        abort_if(Gate::denies('breeding_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg_types = Egg::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $species   = Specie::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.breedingHistories.create', compact('egg_types','species','breedingPair'));
    }

    public function store(StoreBreedingHistoryRequest $request)
    {
        $breedingHistory = BreedingHistory::create($request->all());

        if ($request->egg_type_id == 5) {
            UserBird::create([
                'breeding_history_id' => $breedingHistory->id,
                'mutation_name'       => $request->mutation_name,
                'specie_id'           => $request->specie_id,
                'ring_no'             => $request->ring_no,
                'gender'              => $request->gender,
                'dob'                 => $request->hatch_date,
                'description'         => $request->description
            ]);
        }

        return redirect()->route('admin.breeding-histories.index', $request->pair_id);
    }

    public function edit(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg_types = Egg::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $species   = Specie::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $breedingHistory->load('egg_type', 'user_bird', 'created_by');

        return view('admin.breedingHistories.edit', compact('breedingHistory', 'species', 'egg_types'));
    }

    public function update(UpdateBreedingHistoryRequest $request, BreedingHistory $breedingHistory)
    {
        $breedingHistory->update($request->all());

        if ($request->egg_type_id == 5) {
            UserBird::updateOrCreate(['breeding_history_id' => $breedingHistory->id], [
                'breeding_history_id' => $breedingHistory->id,
                'mutation_name'       => $request->mutation_name ?? '',
                'specie_id'           => $request->specie_id,
                'ring_no'             => $request->ring_no,
                'gender'              => $request->gender,
                'dob'                 => $request->hatch_date,
                'description'         => $request->description
            ]);
        } 
        else {
            UserBird::where('breeding_history_id', $breedingHistory->id)->delete();
        }

        return redirect()->route('admin.breeding-histories.index', $breedingHistory->pair_id);
    }

    public function show(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingHistory->load('egg_type', 'user_bird', 'created_by');

        return view('admin.breedingHistories.show', compact('breedingHistory'));
    }

    public function destroy(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_bird = UserBird::where('breeding_history_id', $breedingHistory->id)->first();

        $breedingHistory->delete();

        if ($user_bird) {
            $user_bird->delete();
        }

        return back();
    }

    public function massDestroy(MassDestroyBreedingHistoryRequest $request)
    {
        UserBird::whereIn('breeding_history_id', request('ids'))->delete();
        BreedingHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
