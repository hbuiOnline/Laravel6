<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class); // SELECT * FROM user where project_id ....
    }

    // hasOne
    // hasMany
    // belongsTo
    // belongsToMany

}
