<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties;

class Cities extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'id';

    protected function property()
    {
        return $this->hasMany(Properties::class,'city_id');
    }
}
