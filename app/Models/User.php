<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ThemeOptions;
use App\Models\Pages;
use App\Models\Properties;
use App\Models\PropertyDetail;
use App\Models\PropertyOptions;
use App\Models\PropertyCategory;
use App\Models\PropertyPrice;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'slug',        
        'password',
        'vpassword',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pages()
    {
        return $this->hasMany(Pages::class,'page_id');
    }

    public function properties()
    {
        return $this->hasMany(Properties::class,'user_id');
    }

    public function propertyDetail()
    {
        return $this->hasMany(PropertyDetail::class,'user_id');
    }

    public function themeOption()
    {
        return $this->hasMany(ThemeOptions::class,'user_id');
    }

    public function propertyCategory()
    {
        return $this->hasMany(PropertyCategory::class,'user_id');
    }

    public function propertyPrice()
    {
        return $this->hasMany(PropertyPrice::class,'user_id');
    }
}
