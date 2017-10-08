<div class="box box-primary" id="box-positions" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-user-secret"></i></span>
            <span>Géo Localisations des Visiteurs</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <div id="map-positions" class="google_maps" style="height: {{ (isset($map_size)) ? $map_size.'px' : '500px' }};"></div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}"></script>
    <script type="text/javascript" charset="utf-8">
		
        $(function ()
        {
			var map;
			var longitude = {{ infos('longitude') }};// 47.93567438543637
			var latitude = {{ infos('latitude') }};// 6.495046332478518

			initToolbarDateRange('#box-positions .daterange', initMapUsersPositions); // Filtres par date qui renvoie start et end à la fonction visée en 2eme parametre

			function addMarker(longitude, latitude, title)
			{
				addGoogleMapMarker(map, longitude, latitude, false, title);
			}
			
			function addMarkerVisitors(data)
			{
				$(data).each(function(i, e){
					if(e[0] == "(not set)") {
						e[0] = "Emplacements inconnus"; e[1] = longitude - 1; e[2] = latitude - 14;
					}
					addMarker(e[1], e[2], e[0] +" : "+ e[3]);
				});
			}
			
			function initMapUsersPositions(start, end)
			{
				map = initGoogleMapView( 'map-positions', longitude, latitude, 5 );
				
				// Entreprise
				addMarker(longitude, latitude, "L'entreprise {{ infos('societe') }}");
				
                if (!start) {
					start = moment().subtract(1, 'year').format('YYYY-MM-DD');
					end = moment().format('YYYY-MM-DD');
				}
				// Visiteurs - XHR
				$('#box-positions .loading-widget').show();
				doAjax('/api/analytics/positions', {
					'start': start, 'end': end,
				}, addMarkerVisitors);
				
			}
            setTimeout( initMapUsersPositions, 1000);
			
        });
    </script>
@endsection