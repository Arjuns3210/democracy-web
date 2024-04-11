<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledContest extends Model
{
    use HasFactory;
    protected $fillable = [
        'contest_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id');
    }
}
