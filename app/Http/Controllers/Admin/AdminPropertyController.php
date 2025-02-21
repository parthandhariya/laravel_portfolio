<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\PropertyDetail;
use RealRashid\SweetAlert\Facades\Alert;

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

        $data = PropertyDetail::where('property_id',$propertyId)->where('image_status','0')->get();

        return view('admin.filter_property_images',compact('data'));
    }

    public function approveImages(Request $request)
    {
        $propertyDetailId = explode(',',$request->imageId);
        
        $imageStatus = ['image_status' => '0']; // Temprory Set '0', instead of '1'
        PropertyDetail::whereIn('id',$propertyDetailId)->update($imageStatus);

        Alert::success('Image Approved Successfully','Thank you');        
        return redirect()->back();
    }

    public function rejectImages(Request $request)
    {
        $propertyDetailId = explode(',',$request->imageId);
        
        $propertyImages = PropertyDetail::whereIn('id',$propertyDetailId)->get();
        $userId = $propertyImages[0]->user_id ?? NULL;
        
        foreach ($propertyImages as $key => $value)
        {
            $temp = $value->property_image;
            $list = explode('/', $temp);
            $fileName = last($list);
            $destinationPath = 'images/property_images/user_'.$userId.'/';
            $path = public_path() .'/'. $destinationPath . $fileName;
            
            if(file_exists($path))
            {
                unlink($path);
                $propertyImages[$key]->property_image = NULL;
                $propertyImages[$key]->image_status = '0';
                $propertyImages[$key]->save();
            }
        }

        Alert::success('Image Rejected Successfully','Thank you');        
        return redirect()->back();
    }
}
