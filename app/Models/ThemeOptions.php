<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class ThemeOptions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'theme_options';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
}
