<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Properties;

class PropertyPrice extends Model
{
    use HasFactory;

    protected $table = 'property_price';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function property()
    {
    	return $this->hasMany(Properties::class,'price_id');
    }
}
