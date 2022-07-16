<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BannerItem extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
    

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('image')
            ->useFallbackUrl(config('app.placeholder').'160.png')
            ->useFallbackPath(config('app.placeholder').'160.png');
    }
}
