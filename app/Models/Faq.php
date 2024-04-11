<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question',
        'answer',
        'status',
        'created_by',
        'updated_by'
    ];

    public static $rules = [];

    public function setQuestionAttribute($value)
    {
        $this->attributes['question'] = strip_tags($value);
    }
    public function getQuestionAttribute($value)
    {
        return ucfirst($value);
    }
}