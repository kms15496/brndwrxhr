<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $guarded = ['id'];

     public function leaves()
    {
        return $this->hasMany(Leave::class, 'leave_type', 'id');
    }
}
