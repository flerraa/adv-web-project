<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'provider',
        'start_date',
        'duration_months',
        'project_leader_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function projectLeader()
    {
        return $this->belongsTo(Academician::class, 'project_leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(Academician::class, 'academician_grant');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}