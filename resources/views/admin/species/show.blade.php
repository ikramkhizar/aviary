@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.specie.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.species.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.specie.fields.name') }}
                        </th>
                        <td>
                            {{ $specie->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specie.fields.bird') }}
                        </th>
                        <td>
                            {{ $specie->bird->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specie.fields.image') }}
                        </th>
                        <td>
                            @if($specie->image)
                                <a href="{{ $specie->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $specie->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.species.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection