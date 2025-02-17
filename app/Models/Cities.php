<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties;
use App\Models\States;

class Cities extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'id';

    public function property()
    {
        return $this->hasMany(Properties::class,'city_id');
    }

    public function state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }
}
