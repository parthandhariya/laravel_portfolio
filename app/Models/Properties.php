<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\PropertyDetail;
use App\Models\PropertyOptions;

class Properties extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'property';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function propertyOption()
    {
        return $this->belongsTo(PropertyOptions::class,'option_id');
    }

    public function propertyDetail()
    {
    	return $this->hasMany(PropertyDetail::class,'property_id');
    }
}