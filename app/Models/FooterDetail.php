<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Footer;


class FooterDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'footer_detail';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function footer()
    {
    	return $this->belongsTo(Footer::class,'footer_id');
    }
}
