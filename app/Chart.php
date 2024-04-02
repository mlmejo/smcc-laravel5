<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class);
    }

    public function remarks()
    {
        return $this->hasMany(Remark::class);
    }
}
