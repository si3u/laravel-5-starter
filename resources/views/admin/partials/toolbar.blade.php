<div class="well well-sm well-toolbar">
    <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/create' }}">
        <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Créer {{ ucfirst($resource) }}
    </a>

    @if(isset($order) && $order === true)
        <a class="btn btn-labeled btn-default text-primary" href="{{ Request::url().'/order' }}">
            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>Ordre {{ ucfirst($resource) }}
        </a>
    @endif
</div>