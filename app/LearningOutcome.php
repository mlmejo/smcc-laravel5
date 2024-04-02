<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningOutcome extends Model
{
    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }
}
