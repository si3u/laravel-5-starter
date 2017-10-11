@section('scripts')
	@parent
	<script type="text/javascript" charset="utf-8">
        $(function () {
			
			
            @if ( session('notify.title') )

					@foreach(session('notify.title') as $k => $v)

						$.notify({
							title: "{!! session("notify.title.$k") !!}",
							content: "{!! session("notify.content.$k") !!}",
							level: "{{ session("notify.level.$k") }}",

							@if (session("notify.icon.$k"))
								icon: "fa fa-{{ session("notify.icon.$k") }}",
							@endif

							@if (session("notify.iconSmall.$k"))
								iconSmall: "fa fa-{{ session("notify.iconSmall.$k") }}",
							@endif

							@if (session("notify.timeout.$k"))
								timeout: {{ session("notify.timeout.$k") }},
							@endif
						});

					@endforeach
		
				{{ session()->forget('notify') }}

            @endif
			
        });
	</script>
@endsection
