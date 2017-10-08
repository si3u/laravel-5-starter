<h3 class="box-title">
    <span><i class="fa fa-table"></i></span>
    <span>{{ isset($title)? $title:'DataTable' }}
        ({{ $fromDate->format('l, d F') }} - {{ $toDate->format('l, d F') }})
    </span>
</h3>

<div class="pull-right box-tools">
    <a href="{{ request()->url() }}/datatable/reset" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Mettre à zéro le filtre par dates">
        <i class="fa fa-refresh"></i>
    </a>

    <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Filtrer par dates">
        <i class="fa fa-calendar"></i>
    </button>

    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Fermer/Ouvrir">
        <i class="fa fa-minus"></i>
    </button>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initDateRangeLatest('#js-box-datatable .daterange', updateDatatables);

            function updateDatatables(start, end)
            {
                doAjax('{{ request()->url() }}/datatable/dates', {
                    'date_from': start, 'date_to': end,
                }, function ()
                {
                    location.reload();
                });
            }
        })
    </script>
@endsection