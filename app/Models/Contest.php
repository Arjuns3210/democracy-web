<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    protected $fillable = [
        "contest_details",
        "name",
        "sub_title",
        "contest_code",
        "registration_start_date",
        "registration_allowed_until",
        "location_id",
        "on_tv",
        "contest_date",
        "winning_award",
        "rules",
        "start_time",
        "end_time",
        "status",
        'created_by',
        'updated_by'
    ] ;

    public static $rules = [];

    const IMAGE= 'image';

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
