@section('scripts')
	@parent
	<script type="text/javascript" charset="utf-8">
        $(function () {
			
			
            @if ( session('notify.title') )

			<?php /*
				*/ ?>
				@if ( is_array(session('notify.title')) )

					@foreach(session('notify.title') as $k => $v)
/* PLUS BESOIN
//						addNotify(
//							"{{ session("notify.title.$k") }}",
//							"{!! session("notify.content.$k") !!}",
//							"{{ session("notify.level.$k") }}",
//							"fa fa-{{ session("notify.icon.$k") }}",
//							"fa fa-{{ session("notify.iconSmall.$k") }}",
//							{{ session("notify.timeout.$k") }}
//						);*/
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
			<?php /*
				*/ ?>
				@else
					
					$.notify({
						title: "{!! session('notify.title') !!}",
						content: "{!! session('notify.content') !!}",
						level: "{{ session('notify.level') }}",

						@if (session('notify.icon'))
							icon: "fa fa-{{ session('notify.icon') }}",
						@endif

						@if (session('notify.iconSmall'))
							iconSmall: "fa fa-{{ session('notify.iconSmall') }}",
						@endif

						@if (session('notify.timeout'))
							timeout: {{ session('notify.timeout') }},
						@endif
					});
				
				@endif
				
				{{ session()->forget('notify') }}

            @endif
			
        });
	</script>
@endsection
