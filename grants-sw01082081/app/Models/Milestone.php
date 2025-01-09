<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = ['name', 'target_date', 'deliverable', 'status', 'grant_id'];

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }
}

