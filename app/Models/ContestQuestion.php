<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestQuestion extends Model
{
    protected $fillable = ['contest_id', 'sequence', 'question_id'];

    public function contest()
    {
        return $this->hasMany(Contest::class, 'contest_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}

