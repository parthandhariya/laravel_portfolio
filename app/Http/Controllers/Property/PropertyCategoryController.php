<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PropertyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('property.add_property_category');
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
        $request->validate([
            'name' => 'required',        
        ]);

        $categoryName = $request->name;
        
        $category = new PropertyCategory();

        $category->user_id = auth()->user()->id;
        $category->name = $categoryName;

        $category->save();
        
        Alert::success('Property Category saved successfully','Thank you');
        
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
        $category = PropertyCategory::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if(is_null($category))
        {
            abort(404);
        }
        return view('property.edit_property_category',compact('category'));
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
            'name' => 'required',        
        ]);
        
        $name = $request->name;

        $row = ['name' => $name];

        PropertyCategory::where('id',$id)->where('user_id',auth()->user()->id)->update($row);

        Alert::success('Property Category saved successfully','Thank you');    
        return redirect()->route('propertycategory.index');
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

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            
            $data = PropertyCategory::where('user_id',auth()->user()->id)->get();
            
            $list = Datatables::of($data)->addIndexColumn()

                
                ->editColumn('created', function($data) {
                    return date('d M Y',strtotime($data->created_at));
                })

                ->editColumn('last_modified', function($data) {
                    return date('d M Y',strtotime($data->updated_at));
                })
                               
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('propertycategory.edit',$row->id).'" class="btn btn-primary btn-sm form-group"><i class="fa fa-edit"></i></a> ';                    
                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
