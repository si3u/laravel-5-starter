
<div class="margin">
<!-- BTN MODAL IMAGES DROPZONE -->
		<button class="btn-modal-images btn btn-default btn-labeled" type="button" data-target=".bd-images-modal-lg">
			<span class="btn-label"><i class="fa fa-picture-o"></i></span>&nbsp; DropZone Images
		</button>
</div>

@section('scripts')
	@parent
	
<script type="text/javascript">
$(function () {
	/* Modal IMAGES for DROPZONE */
	$('.btn-modal-images').click(function() {
		$('.modal.modal-images').on('shown.bs.modal',function(){
			$(this).find('iframe').attr('src',"/admin/dropzone/upload-images/{{ $type }}/{{ (isset($item)) ? $item->id : $id }}");
		});
	    $('.modal.modal-images').modal({show:true});
	    
	   /* $('.modal-images iframe').load(function() {
	        $('.modal-images .loading').fadeOut();
	    }); */
	});
});
</script>

<!-- MODAL DROPZONE IMAGES in bottom DOM -->

		<div class="modal modal-images fade bd-images-modal-lg">
		  <div class="modal-dialog modal-lg" role="document" style="width: 90%">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title">Gérer les images de : {{ $item->title }}</h3>
	 
		        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
	{{--	
		      	<p class="loading text-center" style="margin-bottom: -42px">
					<i class="ion ion-load-c fa-spin fa-3x"></i>
				</p>
		--}}
		        <iframe style="width:100%;min-height:400px;border:none;"></iframe>
				
				<p>
					<small><em>Il faudrait prendre soin de nommer les images avec le titre en relation et pourquoi pas en les numérotant avant de les télécharger !
					<br>La première image téléchargée sera celle par défaut.</em></small>
				</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
		      </div>
		    </div>
		  </div>
		</div>
		

@endsection
