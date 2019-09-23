<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class DriverModel extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'driver_models';

    protected $appends = [
        'driver_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'car_type',
        'car_color',
        'created_at',
        'updated_at',
        'deleted_at',
        'driver_name',
        'driver_phone',
        'driver_location',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getDriverPhotoAttribute()
    {
        $file = $this->getMedia('driver_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
