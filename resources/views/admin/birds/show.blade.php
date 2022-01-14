@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bird.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.birds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bird.fields.id') }}
                        </th>
                        <td>
                            {{ $bird->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bird.fields.name') }}
                        </th>
                        <td>
                            {{ $bird->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bird.fields.image') }}
                        </th>
                        <td>
                            @if($bird->image)
                                <a href="{{ $bird->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bird->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.birds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#bird_species" role="tab" data-toggle="tab">
                {{ trans('cruds.specie.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bird_species">
            @includeIf('admin.birds.relationships.birdSpecies', ['species' => $bird->birdSpecies])
        </div>
    </div>
</div>

@endsection