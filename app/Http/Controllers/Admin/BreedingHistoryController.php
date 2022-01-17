<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBreedingHistoryRequest;
use App\Http\Requests\StoreBreedingHistoryRequest;
use App\Http\Requests\UpdateBreedingHistoryRequest;
use App\Models\BreedingHistory;
use App\Models\Egg;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BreedingHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('breeding_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingHistories = BreedingHistory::with(['egg_type', 'created_by'])->get();

        return view('admin.breedingHistories.index', compact('breedingHistories'));
    }

    public function create()
    {
        abort_if(Gate::denies('breeding_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg_types = Egg::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.breedingHistories.create', compact('egg_types'));
    }

    public function store(StoreBreedingHistoryRequest $request)
    {
        $breedingHistory = BreedingHistory::create($request->all());

        return redirect()->route('admin.breeding-histories.index');
    }

    public function edit(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg_types = Egg::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $breedingHistory->load('egg_type', 'created_by');

        return view('admin.breedingHistories.edit', compact('breedingHistory', 'egg_types'));
    }

    public function update(UpdateBreedingHistoryRequest $request, BreedingHistory $breedingHistory)
    {
        $breedingHistory->update($request->all());

        return redirect()->route('admin.breeding-histories.index');
    }

    public function show(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingHistory->load('egg_type', 'created_by');

        return view('admin.breedingHistories.show', compact('breedingHistory'));
    }

    public function destroy(BreedingHistory $breedingHistory)
    {
        abort_if(Gate::denies('breeding_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $breedingHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyBreedingHistoryRequest $request)
    {
        BreedingHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
