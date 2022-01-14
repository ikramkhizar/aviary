@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.breedingHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.breeding-histories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="clutch_no">{{ trans('cruds.breedingHistory.fields.clutch_no') }}</label>
                <input class="form-control {{ $errors->has('clutch_no') ? 'is-invalid' : '' }}" type="number" name="clutch_no" id="clutch_no" value="{{ old('clutch_no', '') }}" step="1">
                @if($errors->has('clutch_no'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clutch_no') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.clutch_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="egg_type_id">{{ trans('cruds.breedingHistory.fields.egg_type') }}</label>
                <select class="form-control select2 {{ $errors->has('egg_type') ? 'is-invalid' : '' }}" name="egg_type_id" id="egg_type_id">
                    @foreach($egg_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('egg_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <input class="form-control date {{ $errors->has('lay_date') ? 'is-invalid' : '' }}" type="text" name="lay_date" id="lay_date" value="{{ old('lay_date') }}">
                @if($errors->has('lay_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lay_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.lay_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hatch_date">{{ trans('cruds.breedingHistory.fields.hatch_date') }}</label>
                <input class="form-control date {{ $errors->has('hatch_date') ? 'is-invalid' : '' }}" type="text" name="hatch_date" id="hatch_date" value="{{ old('hatch_date') }}">
                @if($errors->has('hatch_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hatch_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.breedingHistory.fields.hatch_date_helper') }}</span>
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