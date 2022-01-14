@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userBird.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-birds.update", [$userBird->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="mutation_name">{{ trans('cruds.userBird.fields.mutation_name') }}</label>
                <input class="form-control {{ $errors->has('mutation_name') ? 'is-invalid' : '' }}" type="text" name="mutation_name" id="mutation_name" value="{{ old('mutation_name', $userBird->mutation_name) }}" required>
                @if($errors->has('mutation_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mutation_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.mutation_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specie_id">{{ trans('cruds.userBird.fields.specie') }}</label>
                <select class="form-control select2 {{ $errors->has('specie') ? 'is-invalid' : '' }}" name="specie_id" id="specie_id">
                    @foreach($species as $id => $entry)
                        <option value="{{ $id }}" {{ (old('specie_id') ? old('specie_id') : $userBird->specie->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.specie_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ring_no">{{ trans('cruds.userBird.fields.ring_no') }}</label>
                <input class="form-control {{ $errors->has('ring_no') ? 'is-invalid' : '' }}" type="text" name="ring_no" id="ring_no" value="{{ old('ring_no', $userBird->ring_no) }}">
                @if($errors->has('ring_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ring_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.ring_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userBird.fields.gender') }}</label>
                @foreach(App\Models\UserBird::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $userBird->gender) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="male_parent">{{ trans('cruds.userBird.fields.male_parent') }}</label>
                <input class="form-control {{ $errors->has('male_parent') ? 'is-invalid' : '' }}" type="text" name="male_parent" id="male_parent" value="{{ old('male_parent', $userBird->male_parent) }}">
                @if($errors->has('male_parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('male_parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.male_parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="female_parent">{{ trans('cruds.userBird.fields.female_parent') }}</label>
                <input class="form-control {{ $errors->has('female_parent') ? 'is-invalid' : '' }}" type="text" name="female_parent" id="female_parent" value="{{ old('female_parent', $userBird->female_parent) }}">
                @if($errors->has('female_parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('female_parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.female_parent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dob">{{ trans('cruds.userBird.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $userBird->dob) }}">
                @if($errors->has('dob'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.userBird.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $userBird->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userBird.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection