@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-2">
        <div class="col-md-6">
            <h3>{{ __('Gallery') }}</h3>
        </div>
        <div class="col-md-6 text-right">
            <a title="{{ __('Upload image') }}" href="{{ route('gallery.create') }}" class="btn btn-success">
                <i class="bi bi-cloud-arrow-up"></i>
                {{ __('Upload image') }}
            </a>
        </div>
    </div>
    @include('gallery.partials.images', ['images' => $images])
</div>
@endsection
