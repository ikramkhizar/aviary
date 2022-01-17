@extends('layouts.admin')
@section('content')
@can('breeding_history_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.breeding-histories.create', $breedingPair->id) }}">
                {{ trans('global.add') }} {{ trans('cruds.breedingHistory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.breedingHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BreedingHistory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.clutch_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.egg_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.lay_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.breedingHistory.fields.hatch_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breedingHistories as $key => $breedingHistory)
                        <tr data-entry-id="{{ $breedingHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $breedingHistory->clutch_no ?? '' }}
                            </td>
                            <td>
                                {{ $breedingHistory->egg_type->name ?? '' }}
                            </td>
                            <td>
                                {{ $breedingHistory->lay_date ?? '' }}
                            </td>
                            <td>
                                {{ $breedingHistory->hatch_date ?? '' }}
                            </td>
                            <td>
                                @can('breeding_history_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.breeding-histories.show', $breedingHistory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('breeding_history_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.breeding-histories.edit', $breedingHistory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('breeding_history_delete')
                                    <form action="{{ route('admin.breeding-histories.destroy', $breedingHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('breeding_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.breeding-histories.massDestroy') }}",
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
    order: [[ 3, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-BreedingHistory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection