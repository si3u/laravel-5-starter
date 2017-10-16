@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Ville - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Titre</label>
                                        <input type="text" class="form-control" value="{{ $item->title }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Région</label>
                                        <input type="text" class="form-control" value="{{ $item->province->title }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false])
                    </form>
                </div>
            </div>
        </div>
    </div>

	@include('admin.locations.map')

@endsection
