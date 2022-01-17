@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Bird
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-birds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.mutation_name') }}
                        </th>
                        <td>
                            {{ $userBird->mutation_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.specie') }}
                        </th>
                        <td>
                            {{ $userBird->specie->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.ring_no') }}
                        </th>
                        <td>
                            {{ $userBird->ring_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\UserBird::GENDER_RADIO[$userBird->gender] ?? '' }}
                        </td>
                    </tr>
                    @if(isset($userBird->maleBirdBreedingPairs->male_bird) || isset($userBird->femaleBirdBreedingPairs->female_bird))
                    <tr>
                        <th>
                            Partner
                        </th>
                        <td>
                            {{ $userBird->maleBirdBreedingPairs->male_bird->mutation_full_name ?? $userBird->femaleBirdBreedingPairs->female_bird->mutation_full_name}}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.male_parent') }}
                        </th>
                        <td>
                            {{ $userBird->male_parent ? $userBird->male_parent : (isset($userBird->breeding_history->breeding_pair->male_bird) ? $userBird->breeding_history->breeding_pair->male_bird->mutation_full_name : '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.female_parent') }}
                        </th>
                        <td>
                            {{ $userBird->female_parent ? $userBird->female_parent : (isset($userBird->breeding_history->breeding_pair->female_bird) ? $userBird->breeding_history->breeding_pair->female_bird->mutation_full_name : '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Age
                        </th>
                        <td>
                            {{ $userBird->dob != '' ? CommonFunction::get_date_diff($userBird->dob) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.dob') }}
                        </th>
                        <td>
                            {{ $userBird->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userBird.fields.description') }}
                        </th>
                        <td>
                            {{ $userBird->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-birds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#male_bird_breeding_pairs" role="tab" data-toggle="tab">
                {{ trans('cruds.breedingPair.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#female_bird_breeding_pairs" role="tab" data-toggle="tab">
                {{ trans('cruds.breedingPair.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="male_bird_breeding_pairs">
            @includeIf('admin.userBirds.relationships.maleBirdBreedingPairs', ['breedingPairs' => $userBird->maleBirdBreedingPairs])
        </div>
        <div class="tab-pane" role="tabpanel" id="female_bird_breeding_pairs">
            @includeIf('admin.userBirds.relationships.femaleBirdBreedingPairs', ['breedingPairs' => $userBird->femaleBirdBreedingPairs])
        </div>
    </div>
</div> --}}

@endsection