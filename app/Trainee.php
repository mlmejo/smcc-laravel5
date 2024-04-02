<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    public function charts()
    {
        return $this->belongsToMany(Chart::class);
    }

    public function remarks()
    {
        return $this->hasMany(Remark::class);
    }
}
