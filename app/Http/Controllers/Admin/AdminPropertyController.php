<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;

class AdminPropertyController extends Controller
{
    public function viewPropertyImages($userId)
    {
        $property = Properties::where('user_id',$userId)->get();

        //dd($property);

        return view('admin.user_property_detail',compact('property'));
    }
}
