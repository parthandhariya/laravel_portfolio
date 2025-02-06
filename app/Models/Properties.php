<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\PropertyDetail;
use App\Models\PropertyOptions;
use App\Models\PropertyCategory;
use App\Models\PropertyPrice;
use App\Models\States;
use App\Models\Cities;

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

    public function propertyCategory()
    {
        return $this->belongsTo(PropertyCategory::class,'category_id');
    }

    public function propertyPrice()
    {
        return $this->belongsTo(PropertyPrice::class,'price_id');
    }

    public function state()
    {
        return $this->belongsTo(States::class,'state_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class,'city_id');
    }
}
