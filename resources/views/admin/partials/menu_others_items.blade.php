
{{-- Sert à naviguer facilement depuis l'édition des Actus ou Réalisations --}}

@if(isset($menuOthersItems))

@section('scripts')
	@parent
	<script type="text/javascript">
		$(function() {
			$(document).on('change', 'select[name=goTo]', function() {
				e = $(this);
				var pattern = new RegExp("/admin/");
				if(pattern.test($(e).val())) { location.href = $(e).val(); }
			});
		});
	</script>
@endsection


<form method="GET" action="#">
	<select class="select2 select2notags" name="goTo">
	
		<option selected="true" class="text-capitalize">
			{{ strtoupper("Navigation - Choisir une autre ").ucfirst(str_singular($selectedNavigation->title) )}}
		</option>
	
	@foreach($menuOthersItems as $item)  
	
		<option value="{{ $selectedNavigation->url.'/'.$item->id.'/edit' }}">
		{{ ($item->category)? '&nbsp;&nbsp;&nbsp;'.$item->category->name:'' }} :&nbsp; {{ $item->title }}
		</option>
	
	@endforeach
</select>
</form>

@endif

		