

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
					<span><i class="fa fa-map-marker"></i></span>
					<span>
						@if($marker)
						Déplacer le marqueur à l'emplacement désiré
						@else
						Vue sur Google Map
						@endif
					</span>
				</h3>
			</div>
			<div class="box-body no-padding">
				<div id="map_canvas" class="google_maps" style="height: 450px;">
					&nbsp;
				</div>
			</div>
		</div>
	</div>
</div>

	
@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            var latitude = {{ isset($item) && strlen($item->latitude) > 2? $item->latitude : 48.856614 }}; /* Paris */
            var longitude = {{ isset($item) && strlen($item->longitude) > 2? $item->longitude : 2.352222 }};
            var zoom_level = {{ isset($item) && strlen($item->zoom_level) >= 1? $item->zoom_level : 6 }};

			var marker = ("{{ isset($marker) && $marker == true }}") ? true : false;
			if (marker) { /* create / edit */
				initGoogleMapEditMarker('map_canvas', latitude, longitude, zoom_level); /* map with placement marker */
			} else { /* show */
				var map = initGoogleMapEditClean('map_canvas', latitude, longitude, zoom_level);
				addGoogleMapMarker(map, latitude, longitude, false, "{{ $selectedNavigation->title .' : '. ( isset($item) ? $item->title : '' ) }}" );
			}
        });
    </script>
@endsection