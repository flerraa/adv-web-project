<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academician extends Model
{
    protected $fillable = ['name', 'email', 'college', 'department', 'position'];

    public function grants()
    {
        return $this->belongsToMany(Grant::class, 'academician_grant');
    }

    public function leadingGrants()
    {
        return $this->hasMany(Grant::class, 'project_leader_id');
    }
}
