
@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
			$("input#slug").slugify("input#id-title"); /* pour remplir le slug et s'en servir pour la création d'un dossier d'images */
			
			/* Message d'aide à la création du dossier */
			alert_btnCND = "{{ isset($id) ? false : true }}"; /* pour n'afficher l'alerte qu'une fois */
			$(document).on('keyup', 'input#id-title', function(event){
				var lenghtTitle = event.currentTarget.textLength;
				if(lenghtTitle >= 4 && alert_btnCND == false) {
					$('#btn-create-new-dir').fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(400); /* clignotements */
					alert_btnCND = true;
					notify('Aide', 'Vous pouvez désormais créer un dossier pour<br> accueillir les images de cette {{ str_singular($selectedNavigation->title) }}<br><br><b>Une fois votre titre bien défini,<br>cliquez sur le bouton venant de s\'afficher.</b><br><br><h4>Un dossier <b>{{ isset($id) ? $id : "X" }}_VOTRE_TITRE</b> sera accessible dans le dossier <b>{{ ucfirst($type) }}</b>.</h4><br>Depuis l\'icône <i class="fa fa-picture-o"></i> dans la barre d\'outils<br> de l\'éditeur du contenu<br>Puis -> parcourir le serveur.<br>', 'info');
				}
			});
			
        });
		
		function createNewDir(dir)
		{
			if(dir) {
				var xhr = $.ajax( { 
					url: '/api/createDirectory/{{$type}}/{{ isset($item) ? $item->id : $id }}_'+dir,
					success: function(res){
						notify('Succès', res);
						$('#btn-create-new-dir').fadeOut(400); /* On cache le bouton de création */
						/* On affiche le bouton filemanager car il n'est pas présent dans le DOM à la création */
						$('#btn-container-actions').html('<a id="btn-open-medias" href="/admin/laravel-filemanager?type=Images" class="btn btn-success btn-labeled margin" target="_blank"><span class="btn-label"><i class="fa fa-picture-o"></i></span>&nbsp; Ouvrir le gestionnaire de médias</a>');
					},
					error: function(){
						notifyError('Erreur', "Une erreur est survenue à la création<br> du dossier<br><br><b>"+dir+"</b><br><br> Dans /photos/shares/{{ ucfirst($type) }}/<br><br><b>Déjà existant ou impossible d'accès.</b>");
					}
				});
			} else {
				notifyError('Oops', 'Veuillez tout d\'abord remplir le champ :<br><b>Titre</b>');
			}
		}
	</script>
@endsection

{{-- Vue servant aux create_edit.blade --}}

<?php $is_pathDir = isset($item) ? is_dir(public_path("photos/shares/".ucfirst($type)."/".$item->id."_".$item->slug)) : false; // pour Afficher/Cacher le bouton de création de dossier ?>

<div id="btn-container-actions">
	<button id="btn-create-new-dir"  type="button" onclick="createNewDir($('input#slug').val());" class="btn btn-info margin" 
			@if( isset($id) || $is_pathDir == true ) style="display: none" @endif >
		<i class="fa fa-picture-o"></i>&nbsp; Créer un @if( ! isset($item)) nouveau @endif dossier pouvant accueillir les images de cette {{ str_singular($selectedNavigation->title) }}
	</button>
	@if( $is_pathDir == true )
	<a href="/admin/laravel-filemanager?type=Images" class="btn btn-success btn-labeled margin" target="_blank">
		<span class="btn-label"><i class="fa fa-picture-o"></i></span>&nbsp; Ouvrir le gestionnaire de médias
	</a>
	@endif
</div>
