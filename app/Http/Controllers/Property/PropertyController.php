<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\PropertyDetail;
use App\Models\PropertyOptions;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyOption = PropertyOptions::pluck('option_name','id')->toArray();

        return view('property.index',compact('propertyOption'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $totalNumbersOfProperty = Properties::where('user_id',auth()->user()->id)->count();

        if($totalNumbersOfProperty == 2)
        {
            Alert::error('Maximum two Properties are allowed','Sorry');        
            return back();
        }


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $property = new Properties();
        
        $property->user_id = auth()->user()->id;
        $property->option_id = $request->option_id;
        $property->title = $request->title;
        $property->description = $request->description;
        $property->price = $request->price;
        

        $property->save();

        for ($i=0; $i < 6; $i++)
        { 
            $propertyDetail = new PropertyDetail();

            $propertyDetail->user_id = auth()->user()->id;
            $propertyDetail->property_id = $property->id;

            $propertyDetail->save();
        }

        Alert::success('Property detail saved successfully','Thank you');
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Properties::where('user_id',auth()->user()->id)->where('id',$id)->first();

        if(is_null($property))
        {
            abort(404);
        }

        $propertyOption = PropertyOptions::pluck('option_name','id')->toArray();

        return view('property.edit',compact('property','propertyOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $property = Properties::findOrFail($id);

        $property->option_id = $request->option_id;
        $property->title = $request->title;
        $property->description = $request->description;
        $property->price = $request->price;

        $property->save();

        Alert::success('Property updated successfully','Thank you');
        
        return redirect()->route('property.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editImage($id)
    {
        $propertyId = $id;
                
        $propertyImages = PropertyDetail::where('user_id',auth()->user()->id)->where('property_id',$propertyId)->where('image_status','0')->get();

        if($propertyImages->count() == 0)
        {
            abort(404);
        }

        return view('property.edit_images',compact('propertyImages'));
    }

    public function updateImage(Request $request)
    {        
        if(count($request->file()) > 0)
        {
            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',                
            ]);

            $propertyId = $request->propertyId;

            $propertyImages = PropertyDetail::where('user_id',auth()->user()->id)->where('property_id',$propertyId)->where('image_status','0')->get();

            foreach ($request->file('images') as $key => $value)
            {                
                $image = $value;
                $imageName = time() . '_' . $image->getClientOriginalName().$key;
                $destinationPath = 'images/property_images/user_'.auth()->user()->id.'/';

                $pathDetail = $image->move(public_path($destinationPath), $imageName);

                $storePath = asset("/images/property_images/user_".auth()->user()->id."/".$imageName);

                if(!is_null($propertyImages[$key]->property_image))
                {
                    $temp = $propertyImages[$key]->property_image;
                    $list = explode('/', $temp);
                    $fileName = last($list);
                    $path = public_path() .'/'. $destinationPath . $fileName;
                    
                    if(file_exists($path)) {
                        
                        unlink($path);              
                    }
                }                    

                $propertyImages[$key]->property_image = $storePath;

                $propertyImages[$key]->save();

            }

            Alert::success('Saved successfully','Thank you');        
            return redirect()->back();
        }
        else
        {
            Alert::error('Choose at least one Property Image','Sorry');
            return redirect()->back();
        }
    }

    public function destroySelectedImage(Request $request)
    {
        $propertyId = explode(',',$request->imageId);
        
        $propertyImages = PropertyDetail::where('user_id',auth()->user()->id)->whereIn('id',$propertyId)->where('image_status','0')->get();
        

        foreach ($propertyImages as $key => $value)
        {
            $temp = $value->property_image;
            $list = explode('/', $temp);
            $fileName = last($list);
            $destinationPath = 'images/property_images/user_'.auth()->user()->id.'/';
            $path = public_path() .'/'. $destinationPath . $fileName;
            
            if(file_exists($path))
            {
                unlink($path);
                $propertyImages[$key]->property_image = NULL;
                $propertyImages[$key]->save();
            }
        }

        Alert::success('Deleted successfully','Thank you');        
        return redirect()->back();
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = Properties::select('id','user_id','option_id','title','description','price','created_at','updated_at')->where('user_id',auth()->user()->id)->get();
            
            $list = Datatables::of($data)->addIndexColumn()

                ->editColumn('title', function($data) {
                    return ucwords($data->title);
                })

                ->editColumn('option_id', function($data) {
                    return $data->propertyOption->option_name ?? "--";
                })

                ->editColumn('price', function($data) {
                    return $data->price ?? "--";
                })

                ->editColumn('created', function($data) {
                    return date('d M Y',strtotime($data->created_at));
                })

                ->editColumn('last_modified', function($data) {
                    return date('d M Y',strtotime($data->updated_at));
                })
                                
                ->addColumn('action', function($row){

                    $btn = '<a href="'.route('property.edit',$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ';

                    $btn .= '<a href="'.route('editpropertyimage',$row->id).'" class="btn btn-secondary btn-sm" title="Add Images"><i class="fa fa-image"></i></a> ';                    
                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}