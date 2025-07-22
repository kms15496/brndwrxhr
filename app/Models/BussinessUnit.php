<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BussinessUnit extends Model
{
    protected $guarded = ['id'];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function employee() {
        return $this->hasMany(User::class);
    }
}
