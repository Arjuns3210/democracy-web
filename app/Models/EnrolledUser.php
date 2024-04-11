<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
    public function contest()
    {
        return $this->belongsTo('App\Models\Contest');
    }
}
