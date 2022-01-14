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
            <table class=" table table-bordered table-striped table-hover datatable datatable-femaleBirdBreedingPairs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.breedingPair.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.breedingPair.fields.male_bird') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.ring_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.breedingPair.fields.female_bird') }}
                        </th>
                        <th>
                            {{ trans('cruds.userBird.fields.ring_no') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breedingPairs as $key => $breedingPair)
                        <tr data-entry-id="{{ $breedingPair->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $breedingPair->id ?? '' }}
                            </td>
                            <td>
                                {{ $breedingPair->male_bird->mutation_name ?? '' }}
                            </td>
                            <td>
                                {{ $breedingPair->male_bird->ring_no ?? '' }}
                            </td>
                            <td>
                                {{ $breedingPair->female_bird->mutation_name ?? '' }}
                            </td>
                            <td>
                                {{ $breedingPair->female_bird->ring_no ?? '' }}
                            </td>
                            <td>
                                @can('breeding_pair_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.breeding-pairs.show', $breedingPair->id) }}">
                                        {{ trans('global.view') }}
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
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-femaleBirdBreedingPairs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection