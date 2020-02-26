<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'question_id', 'body', 'seen'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
