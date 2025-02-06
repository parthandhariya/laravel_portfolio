<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties;

class States extends Model
{
    use HasFactory;

    const INDIAN_COUNTRY_ID = 105;

    protected $table = 'states';
    protected $primaryKey = 'id';

    protected function property()
    {
        return $this->hasMany(Properties::class,'state_id');
    }
}
