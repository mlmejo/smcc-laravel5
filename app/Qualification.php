<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function charts()
    {
        return $this->hasMany(Chart::class);
    }

    public function competencies()
    {
        return $this->hasMany(Competency::class);
    }
}
