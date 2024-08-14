<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties;

class PropertyOptions extends Model
{
    use HasFactory;

    protected $table = 'property_option';
    protected $primaryKey = 'id';

    public function property()
    {
    	return $this->hasMany(Properties::class,'option_id');
    }
}
