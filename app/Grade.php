<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
