<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\Image;
use App\Models\User;
use App\Services\Uploader\ImageUploader;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $images = Image::with('author')->paginate();

        return view('gallery.index', compact('images'));
    }

    /**
     * Display a listing of the resource by author.
     *
     * @param int $userId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userImages(int $userId)
    {
        abort_if(! $user = User::select(['id', 'name'])->where('id', $userId)->first(), 404);

        $userImages = Image::with('author')->whereHas('author', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->paginate();

        return view('gallery.user', compact('userImages', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImageUploadRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $uploader = new ImageUploader($request->file('upload_file'));
            $uploader->save();

            $image = Image::create([
                'filename' => $uploader->fileName(),
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'user_id' => $request->user()->id,
            ]);

            return response()->json([
                'status' => 'ok',
                'url' => route('gallery.show', ['image' => $image->id])
            ]);

        }
        catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
        abort_if(! $image = Image::with('author')->where('id', $id)->first(), 404);

        return view('gallery.show', compact('image'));
    }
}
