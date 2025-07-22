<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = ['id'];

    public function bussinessUnit() {
        return $this->hasMany(BussinessUnit::class);
    }
}
