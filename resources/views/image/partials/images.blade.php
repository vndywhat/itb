<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            {{ $images->links() }}
        </div>
    </div>
    @forelse($images as $image)
        @include('image.partials.card-image', ['image' => $image])
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
