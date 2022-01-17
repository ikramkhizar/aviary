<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFosteringRequest;
use App\Http\Requests\StoreFosteringRequest;
use App\Http\Requests\UpdateFosteringRequest;
use App\Models\Fostering;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FosteringController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fostering_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fosterings = Fostering::with(['breeding_history', 'pair', 'egg_type', 'created_by'])->get();

        return view('admin.fosterings.index', compact('fosterings'));
    }

    public function create()
    {
        abort_if(Gate::denies('fostering_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fosterings.create');
    }

    public function store(StoreFosteringRequest $request)
    {
        $fostering = Fostering::create($request->all());

        return redirect()->route('admin.fosterings.index');
    }

    public function edit(Fostering $fostering)
    {
        abort_if(Gate::denies('fostering_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fostering->load('breeding_history', 'pair', 'egg_type', 'created_by');

        return view('admin.fosterings.edit', compact('fostering'));
    }

    public function update(UpdateFosteringRequest $request, Fostering $fostering)
    {
        $fostering->update($request->all());

        return redirect()->route('admin.fosterings.index');
    }

    public function show(Fostering $fostering)
    {
        abort_if(Gate::denies('fostering_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fostering->load('breeding_history', 'pair', 'egg_type', 'created_by');

        return view('admin.fosterings.show', compact('fostering'));
    }

    public function destroy(Fostering $fostering)
    {
        abort_if(Gate::denies('fostering_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fostering->delete();

        return back();
    }

    public function massDestroy(MassDestroyFosteringRequest $request)
    {
        Fostering::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
