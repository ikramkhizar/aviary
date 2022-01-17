@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.breedingHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.breeding-histories.index', $breedingHistory->pair_id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
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
                    <tr>
                        <th>
                            Mutation Name
                        </th>
                        <td>
                            {{ $breedingHistory->user_bird->mutation_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Specie
                        </th>
                        <td>
                            {{ $breedingHistory->user_bird->specie->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Specie
                        </th>
                        <td>
                            {{ $breedingHistory->user_bird->specie->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Ring No
                        </th>
                        <td>
                            {{ $breedingHistory->user_bird->ring_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Gender
                        </th>
                        <td>
                            {{ isset($breedingHistory->user_bird->gender) ? App\Models\UserBird::GENDER_RADIO[$breedingHistory->user_bird->gender] 
                                : ''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $breedingHistory->user_bird->description ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.breeding-histories.index', $breedingHistory->pair_id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection