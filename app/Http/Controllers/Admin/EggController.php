<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEggRequest;
use App\Http\Requests\StoreEggRequest;
use App\Http\Requests\UpdateEggRequest;
use App\Models\Egg;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EggController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('egg_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eggs = Egg::all();

        return view('admin.eggs.index', compact('eggs'));
    }

    public function create()
    {
        abort_if(Gate::denies('egg_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eggs.create');
    }

    public function store(StoreEggRequest $request)
    {
        $egg = Egg::create($request->all());

        return redirect()->route('admin.eggs.index');
    }

    public function edit(Egg $egg)
    {
        abort_if(Gate::denies('egg_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eggs.edit', compact('egg'));
    }

    public function update(UpdateEggRequest $request, Egg $egg)
    {
        $egg->update($request->all());

        return redirect()->route('admin.eggs.index');
    }

    public function show(Egg $egg)
    {
        abort_if(Gate::denies('egg_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg->load('eggTypeBreedingHistories');

        return view('admin.eggs.show', compact('egg'));
    }

    public function destroy(Egg $egg)
    {
        abort_if(Gate::denies('egg_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $egg->delete();

        return back();
    }

    public function massDestroy(MassDestroyEggRequest $request)
    {
        Egg::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
