<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Explanation extends Model
{
    protected $fillable = [
        'question_id', 'body', 
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
