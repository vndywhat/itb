@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-2">
        <div class="col-md-6">
            <h3>{{ $image->title }}</h3>
        </div>
        <div class="col-md-6 text-right">
            <a title="{{ __('Go to gallery') }}" href="{{ route('images.index') }}" class="btn btn-primary">
                <i class="bi bi-images"></i>
                {{ __('Go to gallery') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img class="card-img" src="https://picsum.photos/200/300" alt="{{ $image->title }}">
                </div>
                <div class="col-md-6">
                    @if($image->description)
                        Description:
                        <p class="text-muted">
                            {{ $image->description }}
                        </p>
                    @endif
                    Uploaded by:
                    <p>
                        <a
                            title="{{ __('Show all images uploaded by this user') }}"
                            href="{{ route('images.user', ['user' => $image->author->id]) }}"
                        >
                            {{ $image->author->name }}
                        </a>
                    </p>
                    Uploaded at:
                    <p>
                        {{ $image->created_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
