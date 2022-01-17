@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fostering.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fosterings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="foster_date">{{ trans('cruds.fostering.fields.foster_date') }}</label>
                <input class="form-control date {{ $errors->has('foster_date') ? 'is-invalid' : '' }}" type="text" name="foster_date" id="foster_date" value="{{ old('foster_date') }}">
                @if($errors->has('foster_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foster_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fostering.fields.foster_date_helper') }}</span>
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