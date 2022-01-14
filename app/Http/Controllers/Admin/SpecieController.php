<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpecieRequest;
use App\Http\Requests\StoreSpecieRequest;
use App\Http\Requests\UpdateSpecieRequest;
use App\Models\Bird;
use App\Models\Specie;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SpecieController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('specie_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $species = Specie::with(['bird', 'media'])->get();

        return view('admin.species.index', compact('species'));
    }

    public function create()
    {
        abort_if(Gate::denies('specie_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $birds = Bird::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.species.create', compact('birds'));
    }

    public function store(StoreSpecieRequest $request)
    {
        $specie = Specie::create($request->all());

        if ($request->input('image', false)) {
            $specie->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $specie->id]);
        }

        return redirect()->route('admin.species.index');
    }

    public function edit(Specie $specie)
    {
        abort_if(Gate::denies('specie_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $birds = Bird::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specie->load('bird');

        return view('admin.species.edit', compact('birds', 'specie'));
    }

    public function update(UpdateSpecieRequest $request, Specie $specie)
    {
        $specie->update($request->all());

        if ($request->input('image', false)) {
            if (!$specie->image || $request->input('image') !== $specie->image->file_name) {
                if ($specie->image) {
                    $specie->image->delete();
                }
                $specie->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($specie->image) {
            $specie->image->delete();
        }

        return redirect()->route('admin.species.index');
    }

    public function show(Specie $specie)
    {
        abort_if(Gate::denies('specie_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specie->load('bird');

        return view('admin.species.show', compact('specie'));
    }

    public function destroy(Specie $specie)
    {
        abort_if(Gate::denies('specie_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specie->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecieRequest $request)
    {
        Specie::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('specie_create') && Gate::denies('specie_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Specie();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
