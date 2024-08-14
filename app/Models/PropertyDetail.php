<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Properties;

class PropertyDetail extends Model
{
     use HasFactory, SoftDeletes;

    protected $table = 'property_detail';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function property()
    {
    	return $this->belongsTo(Properties::class,'property_id');
    }
}
