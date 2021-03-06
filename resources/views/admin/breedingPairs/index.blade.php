@extends('layouts.admin')
@section('content')
@can('breeding_pair_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.breeding-pairs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.breedingPair.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.breedingPair.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BreedingPair">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Male
                        </th>
                        <th>
                            Female
                        </th>
                        <th>
                            {{ trans('cruds.breedingPair.fields.cage_no') }}
                        </th>
                        <th>Clutch</th>
                        <th>No of Eggs</th>
                        <th>Hatched</th>
                        <th>Unhatched</th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breedingPairs as $key => $breedingPair)
                        <tr data-entry-id="{{ $breedingPair->id }}">
                            <td></td>
                            <td>{{ $breedingPair->male_bird->mutation_full_name ?? '' }}</td>
                            <td>{{ $breedingPair->female_bird->mutation_full_name ?? '' }}</td>
                            <td>{{ $breedingPair->cage_no ?? '' }}</td>
                            <td>{{ $breedingPair->breeding_history->sortByDesc('clutch_no')->first()->clutch_no ?? '' }}</td>
                            <td>{{ $breedingPair->breeding_history->count() }}</td>
                            <td>{{ $breedingPair->breeding_history->where('egg_type_id',5)->count() }}</td>
                            <td>{{ $breedingPair->breeding_history->where('egg_type_id','<>',5)->count() }}</td>
                            <td>
                                @can('breeding_pair_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.breeding-histories.index', $breedingPair->id) }}">
                                        View Progress
                                    </a>
                                @endcan

                                @can('breeding_pair_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.breeding-pairs.edit', $breedingPair->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('breeding_pair_delete')
                                    <form action="{{ route('admin.breeding-pairs.destroy', $breedingPair->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Seperate Pair">
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
@can('breeding_pair_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.breeding-pairs.massDestroy') }}",
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
  let table = $('.datatable-BreedingPair:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection