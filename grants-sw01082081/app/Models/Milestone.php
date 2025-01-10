<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'target_date',
        'deliverable',
        'status',
        'grant_id'
    ];

    protected $casts = [
        'target_date' => 'date'
    ];

    // Status constants
    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_COMPLETED = 'Completed';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETED
        ];
    }

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }
}