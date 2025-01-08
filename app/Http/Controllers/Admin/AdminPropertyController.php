<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\PropertyDetail;

class AdminPropertyController extends Controller
{
    public function viewPropertyImages($userId)
    {
        $property = Properties::where('user_id',$userId)->get();
        
        return view('admin.user_property_detail',compact('property'));
    }

    public function filterImageByPropertyId(Request $request)
    {
        $propertyId = $request->property_id;

        $data = PropertyDetail::where('property_id',$propertyId)->get();

        return view('admin.filter_property_images',compact('data'));
    }
}
