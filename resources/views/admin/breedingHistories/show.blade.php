@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.breedingHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.breeding-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $breedingHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.clutch_no') }}
                        </th>
                        <td>
                            {{ $breedingHistory->clutch_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.egg_type') }}
                        </th>
                        <td>
                            {{ $breedingHistory->egg_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.lay_date') }}
                        </th>
                        <td>
                            {{ $breedingHistory->lay_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.hatch_date') }}
                        </th>
                        <td>
                            {{ $breedingHistory->hatch_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.breeding-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection