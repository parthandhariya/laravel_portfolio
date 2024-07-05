<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::where('user_id',auth()->user()->id)->get();

        return view('pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $pages = new Pages();

        $pages->user_id = auth()->user()->id;
        $pages->name = $request->name;
        $pages->status = $request->status;
        
        $dataArray = explode(',', $request->parent_with_level);
        $parent_id = $dataArray[0];
        $level = $dataArray[1] + 1;

        $pages->parent_id = $parent_id;
        $pages->level = $level;

        $pages->save();

        Alert::success('Page created successfully','Thank you');

        return back()->with('success','Page Detail Saved Successfully');
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
        $page = Pages::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if(is_null($page)){
            abort(404);
        }

        $pages = Pages::where('user_id',auth()->user()->id)->get();
        return view('pages.edit',compact('page','pages'));
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
        $page = Pages::findOrFail($id);

        $page->name = $request->name;
        $page->status = $request->status;

        $dataArray = explode(',', $request->parent_with_level);
        $parent_id = $dataArray[0];
        $level = $dataArray[1] + 1;

        $page->parent_id = $parent_id;
        $page->level = $level;

        $page->save();

        Alert::success('Page updated successfully','Thank you');

        return redirect()->route('pages.index')->with('success','Page Detail Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        
        $page = Pages::findOrFail($id);

        $page->delete();

        Alert::success('Page deleted successfully','Thank you');
        
        return redirect()->route('pages.index');
    }*/

    public function destroy($id)
    {     
        // Getting the parent category
        $parent = Pages::findOrFail($id);
        
        // Getting all children ids
        $array_of_ids = $this->getChildren($parent);
        // Appending the parent category id
        
        array_push($array_of_ids, $id);
        // Destroying all of them
        Pages::destroy($array_of_ids);
    }

    private function getChildren($category)
    {
        /*if(is_null($category))
        {
            Alert::success('Pages deleted successfully','Thank you');
        
            return redirect()->route('pages.index');
        }*/

        $ids = [];
        foreach ($category->children as $cat)
        {
            $ids[] = $cat->id;
            $ids = array_merge($ids, $this->getChildren($cat));
        }

        return $ids;
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = Pages::select('id','name','parent_id','status')->where('user_id',auth()->user()->id)->get();
            $list = Datatables::of($data)->addIndexColumn()

                ->editColumn('parent_id', function(pages $page) {
                    return $page->page->name ?? 'Root';
                })
                ->editColumn('status', function(pages $page) {
                    return $page->status == "1" ? 'Active' : 'Inactive';
                })                
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('pages.edit',$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ';
                    /*$btn .= '<a href="javascript:;" class="btn btn-danger btn-sm" id="btn_delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';*/
                    return $btn;
                })
                /*->addIndexColumn()*/
                ->rawColumns(['action'])
                ->make(true);

            return $list;
        }
    }
}
