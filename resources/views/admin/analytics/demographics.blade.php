@extends('layouts.admin')

@section('content')
    {{-- demographics --}}
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.analytics.visitors_positions', ['map_size' => 700])
        </div>
    </div>
	{{--
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.analytics.gender')
        </div>

        <div class="col-md-6">
            @include('admin.partials.analytics.age')
        </div>
    </div>
	--}}
@endsection