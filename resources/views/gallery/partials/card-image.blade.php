<div class="col-md-4 mb-2">
    <div class="card">
        <div class="card-header">
            <a title="{{ $image->title }}" href="{{ route('gallery.show', ['image' => $image->id]) }}">
                {{ \Illuminate\Support\Str::limit($image->title, 35) }}
            </a>
        </div>
        <div class="card-body">
            <a
                href="{{ route('gallery.show', ['image' => $image->id]) }}"
                title="{{ __('Show full image') }}"
            >
                <img class="card-img" src="{{ $image->thumbnail }}" alt="{{ $image->title }}">
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
            by <a title="{{ __('Show all images uploaded by this user') }}" href="{{ route('gallery.user', ['user' => $image->author->id]) }}">
                {{ $image->author->name }}
            </a>
            in {{ $image->created_at->format('d M Y H:i') }}
        </div>
    </div>
</div>
