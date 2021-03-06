<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'title',
        'description',
        'user_id',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 6;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail'
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getThumbnailAttribute(): string
    {
        if(! \Storage::disk('public')->exists('images/thumbnail_' . $this->filename)) {
            return $this->getImageUrl();
        }

        return \Storage::url('public/images' . '/thumbnail_' . $this->filename);
    }

    public function getImageUrl(): string
    {
        if(! \Storage::disk('public')->exists('images/' . $this->filename)) {
            return asset('img/no-image.png');
        }

        return \Storage::url('public/images' . '/' . $this->filename);
    }
}
