<?php

namespace App\Http\Controllers\ThemeOption;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThemeOptions;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ThemeOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('themeoption.index');
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

        $customMessages = [            
            'site_favicon.max' => 'The Favicon image may not be greater than 2MB.',
            'site_logo.max' => 'The Site Logo may not be greater than 2MB.',
        ];

        $request->validate([
            'site_favicon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_name' => 'required',
        ], $customMessages);

        
        $themeOption = new ThemeOptions();

        $checkForExist = ThemeOptions::where('user_id',auth()->user()->id)->first();
        /*$checkForExist = ThemeOptions::first();*/

        if(!is_null($checkForExist))
        {
            Alert::error('Delete old theme or Update existing one','Alert');
            return back();
        }

        $themeOption->user_id = auth()->user()->id;

        if ($request->hasFile('site_favicon'))
        {
            $image = $request->file('site_favicon');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = 'images/site_favicon';
            $pathDetail = $image->move(public_path($destinationPath), $imageName);

            $storePath = asset("/images/site_favicon/".$imageName);                    

            $themeOption->site_favicon = $storePath;
        }

        if ($request->hasFile('site_logo'))
        {
            $image = $request->file('site_logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = 'images/site_logo';
            $pathDetail = $image->move(public_path($destinationPath), $imageName);

            $storePath = asset("/images/site_logo/".$imageName);                    

            $themeOption->site_logo = $storePath;
        }

        $themeOption->site_name = $request->site_name;

        $themeOption->save();

        Alert::success('Theme Option saved successfully','Thank you');
        
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
        $viewObject = ThemeOptions::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if(is_null($viewObject)){
            abort(404);
        }
        return view('themeoption.edit',compact('viewObject'));
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
            'site_name' => 'required',            
        ],);
        
        $themeOption = ThemeOptions::findOrFail($id);

        $themeOption->site_name = $request->site_name;

        if ($request->hasFile('site_favicon'))
        {   
            if(!is_null($themeOption->site_favicon))
            {
                $temp = $themeOption->site_favicon;
                $list = explode('/', $temp);
                $fileName = last($list);
                $path = public_path() . '/images/site_favicon/'.$fileName;
                if(file_exists($path)) {
                    unlink($path);              
                }
            }         
            
            $image = $request->file('site_favicon');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = 'images/site_favicon';
            $pathDetail = $image->move(public_path($destinationPath), $imageName);

            $storePath = asset("/images/site_favicon/".$imageName);                    

            $themeOption->site_favicon = $storePath;
        }

        if ($request->hasFile('site_logo'))
        {
            if(!is_null($themeOption->site_logo))
            {
                $temp = $themeOption->site_logo;
                $list = explode('/', $temp);
                $fileName = last($list);
                $path = public_path() . '/images/site_logo/'.$fileName;
                if(file_exists($path)) {
                    unlink($path);              
                }
            }

            $image = $request->file('site_logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = 'images/site_logo';
            $pathDetail = $image->move(public_path($destinationPath), $imageName);

            $storePath = asset("/images/site_logo/".$imageName);                    

            $themeOption->site_logo = $storePath;
        }

        $themeOption->user_id = auth()->user()->id;

        $themeOption->save();

        Alert::success('Theme Option updated successfully','Thank you');
        
        return redirect()->route('themeoption.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $themeOption = ThemeOptions::findOrFail($id);

        //dd($themeOption);
        
        if(!is_null($themeOption->site_favicon))
        {
            $temp = $themeOption->site_favicon;
            $list = explode('/', $temp);
            $fileName = last($list);
            $path = public_path() . '/images/site_favicon/'.$fileName;
            if(file_exists($path)) {
                unlink($path);              
            }
        }

        if(!is_null($themeOption->site_logo))
        {
            $temp = $themeOption->site_logo;
            $list = explode('/', $temp);
            $fileName = last($list);
            $path = public_path() . '/images/site_logo/'.$fileName;
            if(file_exists($path)) {
                unlink($path);              
            }
        }

        $themeOption->delete();

        Alert::success('Theme Option deleted successfully','Thank you');
        
        return redirect()->route('themeoption.index');
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = ThemeOptions::select('id','user_id','site_favicon','site_logo','site_name')->where('user_id',auth()->user()->id)->get();
            
            $list = Datatables::of($data)->addIndexColumn()

                /*->editColumn('user', function($data) {
                    return $data->user->name;
                })*/

                ->editColumn('site_favicon', function($data) {
                    return '<a href="javascript:;" class="a-fancybox" data-fancybox="'.$data->site_favicon.'"><img src='.$data->site_favicon.' class="fancybox" height="40" width="40" /></a>';                    
                })
                ->editColumn('site_logo', function($data) {
                    return '<a href="javascript:;" class="a-fancybox" data-fancybox="'.$data->site_logo.'"><img src='.$data->site_logo.' class="fancybox" height="40" width="40" /></a>';                    
                })                
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('themeoption.edit',$row->id).'" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ';
                    $btn .= '<a href="javascript:;" class="btn btn-danger btn-sm" id="btn_delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['site_favicon','site_logo'],['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
