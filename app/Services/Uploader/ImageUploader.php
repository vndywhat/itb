<?php

namespace App\Services\Uploader;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageUploader
{
    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * Returns name of file.
     *
     * @return string
     */
    public function fileName(): string
    {
        return $this->uploadedFile->hashName();
    }

    /**
     * Saves image and thumbnail to disk.
     *
     * @throws \Exception
     */
    public function save(): bool
    {
        $pathToFile = $this->uploadedFile->storeAs('public/images', $this->fileName());

        if(! \Storage::exists($pathToFile)) {
            throw new \Exception('An error occurred while uploading the file', 500);
        }

        $thumbnail = $this->createThumbnail(\Storage::path($pathToFile));

        if(! ($thumbnail instanceof \Intervention\Image\Image)) {
            throw new \Exception('Can not create a thumbnail image', 500);
        }

        return true;
    }

    /**
     * Create a thumbnail of uploaded image.
     *
     * @param string $fullPath
     * @return \Intervention\Image\Image
     */
    protected function createThumbnail(string $fullPath): \Intervention\Image\Image
    {
        $pathToDirectory = dirname($fullPath);

        return Image::make($fullPath)
            ->resize(300, 300)
            ->save($pathToDirectory . '/thumbnail_' . $this->fileName());
    }
}
