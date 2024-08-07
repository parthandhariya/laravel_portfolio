<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties;
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
        return view('property.index');
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
        $property = new Properties();

        $imageIds = json_encode(['0','1','2','3','4','5']);

        $property->user_id = auth()->user()->id;
        $property->title = $request->title;
        $property->images = $imageIds;

        $property->save();

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
        //
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
        //
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

        $property = Properties::where('id',$propertyId)->where('user_id',auth()->user()->id)->first();

        if(is_null($property)){
            abort(404);
        }

        return view('property.edit_images',compact('property'));
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = Properties::select('id','user_id','title','description','images')->where('user_id',auth()->user()->id)->get();
            
            $list = Datatables::of($data)->addIndexColumn()

                ->editColumn('title', function($data) {
                    return $data->title;
                })

                                
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('editpropertyimage',$row->id).'" class="btn btn-primary btn-sm" title="Add Image"><i class="fa fa-image"></i></a> ';
                    /*$btn .= '<a href="javascript:;" class="btn btn-danger btn-sm" id="btn_delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';*/
                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
