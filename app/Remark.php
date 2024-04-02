<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    public function chart()
    {
        return $this->belongsTo(Chart::class);
    }

    public function learningOutcome()
    {
        return $this->belongsTo(LearningOutcome::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
