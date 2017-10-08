@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-bar-chart"></i></span>
                        <span>Sommaire</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <table class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                        <tr>
                            <th data-class="expand">Description</th>
                            <th>Total</th>
                            <th>Répondre</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{!! $item[0] !!}</td>
                                <td>{!! $item[1] !!}</td>
								<td>
                                @if(!empty($item[2]))
									@foreach($item[2] as $v)
									<a href="mailto:{{ $v[1] }}?subject=[{{ infos('societe') }}] {{ $v[0] }}, réponse à votre demande">{{ $v[0] }}</a><br>
									@endforeach
								@endif
								</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection