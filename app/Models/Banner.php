<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;


class Banner extends Model implements HasMedia

{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'image',
        'created_by',
        'updated_by',
    ];

    const IMAGE= 'image';

}
