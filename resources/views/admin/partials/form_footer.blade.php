<div class="form-footer">
    @if(isset($submit) == false || $submit == true)
        <button class="btn btn-labeled btn-primary btn-submit">
            <span class="btn-label"><i class="fa fa-fw fa-save"></i></span>Enregistrer
        </button>
    @endif

    @if(isset($linkEdit) && $linkEdit == true)
	<a href="{{ Request::url() }}/edit" class="btn btn-labeled btn-primary">
            <span class="btn-label"><i class="fa fa-fw fa-edit"></i></span>&Eacute;diter
        </a>
    @endif
	
	<a href="" class="btn btn-labeled btn-default" title="rafraîchir la page">
		<span class="btn-label"><i class="fa fa-refresh fa-fw"></i></span>Actualiser
	</a>

    <a href="javascript:window.history.back();" class="btn btn-labeled btn-default">
        <span class="btn-label"><i class="fa fa-fw fa-chevron-left"></i></span>Retour
    </a>
</div>