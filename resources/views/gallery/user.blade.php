@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-2">
            <div class="col-md-6">
                <h3>{{ __('Images uploaded by') . ' ' . $user->name }} </h3>
            </div>
            <div class="col-md-6 text-right">
                <a title="{{ __('Go to gallery') }}" href="{{ route('gallery.index') }}" class="btn btn-primary">
                    <i class="bi bi-images"></i>
                    {{ __('Go to gallery') }}
                </a>
            </div>
        </div>
        @include('gallery.partials.images', ['images' => $userImages])
    </div>
@endsection
