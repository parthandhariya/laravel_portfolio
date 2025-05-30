<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterDetail;

class Footer extends Model
{
    use HasFactory;

    const FOOTER_TOTAL_HEADING = 4;

    protected $table = 'footer';
    protected $primaryKey = 'id';
   
}
