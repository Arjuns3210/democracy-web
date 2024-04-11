<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'state_name',
        'status',
        'created_by',
        'updated_by'
    ] ;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
