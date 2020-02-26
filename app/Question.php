<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'grade_id', 'subject_id', 'user_id', 'body', 'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function explanation()
    {
        return $this->hasOne(Explanation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
