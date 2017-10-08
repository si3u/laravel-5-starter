@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Bannière - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <section class="form-group">
                                        <label>Titre</label>
                                        <input type="text" class="form-control" value="{{ $item->title }}" readonly>
                                    </section>
                                </section>

                                <section class="col col-6">
                                    <section class="form-group">
                                        <label>Sous titre</label>
                                        <input type="text" class="form-control" value="{{ $item->subtitle }}" readonly>
                                    </section>
                                </section>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Texte bouton</label>
                                        <input type="text" class="form-control" value="{{ $item->action_title }}" readonly>
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Lien bouton</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->action_link }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Actif depuis le</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->active_from }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Jusqu'au</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->active_to }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            @if(isset($item) && $item && $item->image)
                                <section>
                                    <img src="{{ uploaded_images_url($item->image) }}" style="max-height: 300px;">
                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                </section>
                            @endif
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false, 'linkEdit' => true])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection