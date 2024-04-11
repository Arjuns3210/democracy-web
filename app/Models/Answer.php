<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function option()
    {
        return $this->belongsTo(QuestionOption::class,'option_id');
    }
}
