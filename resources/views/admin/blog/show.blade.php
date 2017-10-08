@extends('layouts.admin')

@section('styles')
	@parent
	<link rel="stylesheet" href="/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
@endsection

@section('scripts')
	@parent
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox.js"></script>
@endsection


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Réalisation - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Titre</label>
                                        <input type="text" class="form-control" value="{{ $item->title }}" readonly>
                                    </section>
                                </div>

                                <div class="col col-4">
                                    <section class="form-group form-group-sm">
                                        <label>ID / Slug</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" disabled>id: <b>{{ $item->id }}</b></span>
											<input type="text" class="form-control input-xs" value="{{ $item->slug }}" readonly>
										</div>
                                    </section>
                                </div>

                                <div class="col col-2">
                                    <div class="form-group">
                                        <label>En ligne depuis le</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" value="{{ $item->active_from }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" value="{{ $item->summary }}" readonly>
                            </div>


                            <div class="row">
                                 <div class="col col-2">
                                    <div class="form-group">
                                        <label>Catégorie</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-cubes"></i></span>
											<input type="text" class="form-control" value="{{ $item->category->name }}" readonly>
										</div>
                                    </div>
                                </div>
	  
							<div class="form-group">
								<label>Mots clé</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key"></i></span>
									<span class="input-group-addon"><b>{{ countKeywords($item->keywords) }}</b></span>
									<input type="text" class="form-control" value="{{ $item->keywords }}" readonly>
								</div>
							</div>

			 {{--	 <!-- 		<div class="col col-4">
                                    <div class="form-group">
                                        <label>Jusqu'au</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" value="{{ $item->active_to }}" readonly>
                                        </div>
                                    </div>
                                </div>
								-->		--}}
					
                            </div>
							

                            <div class="form-group">
                                <label>Contenu</label>
                                <div class="well well-sm">
                                    <div>{!! $item->content !!}</div>
                                </div>
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false, 'linkEdit' => true])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection