<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function learningOutcomes()
    {
        return $this->hasMany(LearningOutcome::class);
    }
}
