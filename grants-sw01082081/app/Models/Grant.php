<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    protected $fillable = ['title', 'amount', 'provider', 'start_date', 'duration_months', 'project_leader_id'];

    public function academicians()
    {
        return $this->belongsToMany(Academician::class, 'academician_grant');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function projectLeader()
    {
        return $this->belongsTo(Academician::class, 'project_leader_id');
    }
}

