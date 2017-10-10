
@section('scripts')
	@parent
	<script type="text/javascript" charset="utf-8">
        $(function () {
			
            @if ( session('notify') )

				@foreach(session('notify') as $k => $v)

					$.notify({
						title: "{!! $v["title"] !!}",
						content: "{!! $v["content"] !!}",
						level: "{{ $v["level"] }}",

						@if ($v["icon"])
							icon: "fa fa-{{ $v["icon"] }}",
						@endif

						@if ($v["iconSmall"])
							iconSmall: "fa fa-{{ $v["iconSmall"] }}",
						@endif

						@if ($v["timeout"])
							timeout: {{ $v["timeout"] }},
						@endif
					});
				@endforeach
			@endif
        });
	</script>
@endsection
