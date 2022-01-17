@extends('layouts.admin')
@section('content')

<div class="form-group">
    <a class="btn btn-primary" href="{{ route('admin.breeding-histories.index', $breedingHistory->pair_id) }}">
        {{ trans('global.back_to_list') }}
    </a>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.breedingHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.breeding-histories.update", [$breedingHistory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="clutch_no">{{ trans('cruds.breedingHistory.fields.clutch_no') }}</label>
                <input class="form-control {{ $errors->has('clutch_no') ? 'is-invalid' : '' }}" type="number" name="clutch_no" id="clutch_no" value="{{ old('clutch_no', $breedingHistory->clutch_no) }}" step="1">
                @if($errors->has('clutch_no'))
                <div class="invalid-feedback">
                    {{ $errors->first('clutch_no') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.clutch_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="egg_type_id">{{ trans('cruds.breedingHistory.fields.egg_type') }}</label>
                <select class="form-control select2 {{ $errors->has('egg_type') ? 'is-invalid' : '' }}" name="egg_type_id" id="egg_type_id" 
                    onchange="triggerDate()">>
                    @foreach($egg_types as $id => $entry)
                    <option value="{{ $id }}" {{ (old('egg_type_id') ? old('egg_type_id') : $breedingHistory->egg_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('egg_type'))
                <div class="invalid-feedback">
                    {{ $errors->first('egg_type') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.egg_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lay_date">{{ trans('cruds.breedingHistory.fields.lay_date') }}</label>
                <input class="form-control date {{ $errors->has('lay_date') ? 'is-invalid' : '' }}" type="text" name="lay_date" id="lay_date" value="{{ old('lay_date', $breedingHistory->lay_date) }}">
                @if($errors->has('lay_date'))
                <div class="invalid-feedback">
                    {{ $errors->first('lay_date') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.lay_date_helper') }}</span>
            </div>
            <div class="hatch_date_area">
                <div class="form-group">
                    <label for="hatch_date">{{ trans('cruds.breedingHistory.fields.hatch_date') }}</label>
                    <input class="form-control date {{ $errors->has('hatch_date') ? 'is-invalid' : '' }}" type="text" name="hatch_date" id="hatch_date" value="{{ old('hatch_date', $breedingHistory->hatch_date) }}">
                    @if($errors->has('hatch_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hatch_date') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.breedingHistory.fields.hatch_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mutation_name">{{ trans('cruds.userBird.fields.mutation_name') }}</label>
                    <input class="form-control {{ $errors->has('mutation_name') ? 'is-invalid' : '' }}" type="text" name="mutation_name" id="mutation_name" value="{{ old('mutation_name', ($breedingHistory->user_bird->mutation_name ?? '')) }}">
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
                        <option value="{{ $id }}" {{ old('specie_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                    <input class="form-control {{ $errors->has('ring_no') ? 'is-invalid' : '' }}" type="text" name="ring_no" id="ring_no" value="{{ old('ring_no', '') }}">
                    @if($errors->has('ring_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ring_no') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userBird.fields.ring_no_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.userBird.fields.gender') }}</label><br>
                    @foreach(App\Models\UserBird::GENDER_RADIO as $key => $label)
                    <div class="form-check d-inline mr-3 {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '0') === (string) $key ? 'checked' : '' }}>
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
                    <label for="description">{{ trans('cruds.userBird.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userBird.fields.description_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    triggerDate();

    function triggerDate() {
        let egg_id = document.querySelector('#egg_type_id option:checked').value;

        if (egg_id == 5) {
            document.querySelector('.hatch_date_area').style.display = 'block';
        } else {
            document.querySelector('.hatch_date_area').style.display = "none";
            document.querySelector('#hatch_date').value = null;
        }
    }


</script>

@endsection