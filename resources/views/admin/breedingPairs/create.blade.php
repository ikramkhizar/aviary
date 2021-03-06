@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.breedingPair.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.breeding-pairs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="male_bird_id">{{ trans('cruds.breedingPair.fields.male_bird') }}</label>
                <select class="form-control select2 {{ $errors->has('male_bird') ? 'is-invalid' : '' }}" name="male_bird_id" id="male_bird_id" required>
                    @foreach($male_birds as $id => $entry)
                        <option value="{{ $id }}" {{ old('male_bird_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('male_bird'))
                    <div class="invalid-feedback">
                        {{ $errors->first('male_bird') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingPair.fields.male_bird_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="female_bird_id">{{ trans('cruds.breedingPair.fields.female_bird') }}</label>
                <select class="form-control select2 {{ $errors->has('female_bird') ? 'is-invalid' : '' }}" name="female_bird_id" id="female_bird_id" required>
                    @foreach($female_birds as $id => $entry)
                        <option value="{{ $id }}" {{ old('female_bird_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('female_bird'))
                    <div class="invalid-feedback">
                        {{ $errors->first('female_bird') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingPair.fields.female_bird_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cage_no">{{ trans('cruds.breedingPair.fields.cage_no') }}</label>
                <input class="form-control {{ $errors->has('cage_no') ? 'is-invalid' : '' }}" type="number" name="cage_no" id="cage_no" value="{{ old('cage_no', '') }}" step="1" min="1" oninput="validity.valid||(value='');" required>
                @if($errors->has('cage_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cage_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingPair.fields.cage_no_helper') }}</span>
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