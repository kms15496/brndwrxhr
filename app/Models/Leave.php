<?php

namespace App\Models;

use App\Observers\LeaveObserver;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $guarded = ['id'];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::observe(LeaveObserver::class);
    }
}
