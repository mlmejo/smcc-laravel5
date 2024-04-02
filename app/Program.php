<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}
