@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pb-2">
        <div class="col-md-6">
            <h3>{{ __('Gallery') }}</h3>
        </div>
        <div class="col-md-6 text-right">
            <a title="{{ __('Upload image') }}" href="{{ route('images.create') }}" class="btn btn-success">
                <i class="bi bi-cloud-arrow-up"></i>
                {{ __('Upload image') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                {{ $images->links() }}
            </div>
        </div>
        @forelse($images as $image)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <a title="{{ $image->title }}" href="{{ route('images.show', ['image' => $image->id]) }}">
                            {{ \Illuminate\Support\Str::limit($image->title, 35) }}
                        </a>
                    </div>
                    <div class="card-body">
                        <a
                            href="{{ route('images.show', ['image' => $image->id]) }}"
                            title="{{ __('Show full image') }}"
                        >
                            <img class="card-img" src="https://picsum.photos/200/300" alt="{{ $image->title }}">
                        </a>
                        @if($image->description)
                            <p class="mt-2">
                                <small class="text-muted">
                                    {{ $image->description }}
                                </small>
                            </p>
                        @endif
                    </div>
                    <div class="card-footer">
                        by <a href="/profile/1">{{ $image->author->name }}</a>
                        in {{ $image->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        {{ __('Nothing found...') }}
                    </div>
                </div>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="float-right">
                {{ $images->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
