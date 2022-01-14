@extends('layouts.admin')
@section('content')
@can('user_bird_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-birds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userBird.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userBird.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserBird">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.mutation_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.specie') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.ring_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.male_parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.female_parent') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.dob') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userBirds as $key => $userBird)
                        <tr data-entry-id="{{ $userBird->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userBird->mutation_name ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->specie->name ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->ring_no ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UserBird::GENDER_RADIO[$userBird->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->male_parent ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->female_parent ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->dob ?? '' }}
                            </td>
                            <td>
                                {{ $userBird->description ?? '' }}
                            </td>
                            <td>
                                @can('user_bird_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-birds.show', $userBird->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_bird_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-birds.edit', $userBird->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_bird_delete')
                                    <form action="{{ route('admin.user-birds.destroy', $userBird->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_bird_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-birds.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-UserBird:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection