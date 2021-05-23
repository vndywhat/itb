@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="errorsBag" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div class="card">
                <div class="card-header">
                    {{ __('Upload image') }}
                </div>
                <div class="card-body">
                    <form id="upload-form" action="{{ route('images.store') }}" enctype="multipart/form-data">

                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="input-title">Title</label>
                            <input type="text" class="form-control" id="input-title" required>
                        </div>
                        <div class="form-group">
                            <label for="input-description">Description</label>
                            <textarea
                                class="form-control"
                                id="input-description"
                                rows="3"
                                placeholder="Description of image (may be empty)"
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="input-image">Select the image</label>
                            <input type="file" class="form-control-file" id="input-image">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000"
         style="position: absolute; top: 10%; right: 2%;">
        <div class="toast-header">
            <strong class="mr-auto">Success!</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Image was uploaded!
        </div>
    </div>
</div>
@endsection
