<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterDetail;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer';
    protected $primaryKey = 'id';

    public function footerDetail()
    {
    	return $this->hasMany(FooterDetail::class,'footer_id');
    }
}
