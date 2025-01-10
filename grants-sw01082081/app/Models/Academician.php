<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academician extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'college',
        'department',
        'position'
    ];

    public function ledGrants()
    {
        return $this->hasMany(Grant::class, 'project_leader_id');
    }

    public function memberGrants()
    {
        return $this->belongsToMany(Grant::class, 'academician_grant');
    }
}