<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    use HasFactory;
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
