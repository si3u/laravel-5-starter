
@if(isset($item))

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
       
		function toggleTag(button, tag_slug, tag_name)
		{
			$.ajax( { 
				url: "/api/toggle-tag/{{ $model }}/{{ $item->id }}/" + tag_slug, /* $model STRING, passé depuis l'appel de ce partial */
			
				success: function(res){
					if(res[0] == 'success') {
						notify('Succès', res[1], 'success');
						button.toggleClass('btn-info');
					} else {
						notifyError('Erreur', res[1]);
					}
				},
				error: function(){
					notifyError('Erreur', "Une erreur est survenue avec l'étiquette <b>"+ tag_name +"</b>.");
				}
			});
		}
	</script>
@endsection

{{-- Laravel-Taggable - https://github.com/summerblue/laravel-taggable --}}

<div class="col-md-12">
	<label><i class="fa fa-tags"></i>&nbsp; &Eacute;tiquettes</label>
	<br/>
	<div class="btn-group btn-group-xs">

	@foreach($tags as $tag)

		<button type="button" class="btn btn-default @if( in_array( $tag->slug, $item->tags->pluck('slug')->all() ) ) btn-info @endif"
				onclick="toggleTag($(this), '{{ $tag->slug }}', '{{ $tag->name }}')">
			{{ $tag->name }}
		</button>

	@endforeach

	</div>
	<br/>
	<br/>
</div>

@endif