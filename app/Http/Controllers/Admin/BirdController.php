<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBirdRequest;
use App\Http\Requests\StoreBirdRequest;
use App\Http\Requests\UpdateBirdRequest;
use App\Models\Bird;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BirdController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bird_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $birds = Bird::with(['media'])->get();

        return view('admin.birds.index', compact('birds'));
    }

    public function create()
    {
        abort_if(Gate::denies('bird_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.birds.create');
    }

    public function store(StoreBirdRequest $request)
    {
        $bird = Bird::create($request->all());

        if ($request->input('image', false)) {
            $bird->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bird->id]);
        }

        return redirect()->route('admin.birds.index');
    }

    public function edit(Bird $bird)
    {
        abort_if(Gate::denies('bird_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.birds.edit', compact('bird'));
    }

    public function update(UpdateBirdRequest $request, Bird $bird)
    {
        $bird->update($request->all());

        if ($request->input('image', false)) {
            if (!$bird->image || $request->input('image') !== $bird->image->file_name) {
                if ($bird->image) {
                    $bird->image->delete();
                }
                $bird->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bird->image) {
            $bird->image->delete();
        }

        return redirect()->route('admin.birds.index');
    }

    public function show(Bird $bird)
    {
        abort_if(Gate::denies('bird_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bird->load('birdSpecies');

        return view('admin.birds.show', compact('bird'));
    }

    public function destroy(Bird $bird)
    {
        abort_if(Gate::denies('bird_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bird->delete();

        return back();
    }

    public function massDestroy(MassDestroyBirdRequest $request)
    {
        Bird::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bird_create') && Gate::denies('bird_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bird();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
