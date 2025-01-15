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
        $themeOption = ThemeOptions::where('user_id',auth()->user()->id)->first();
        
        $totalBannerImages = $themeOption::TOTAL_BANNER_IMAGES;        
        $bannerImages = json_decode($themeOption->banner_images,true) ?? NULL;        
        
        return view('themeoption.index',compact('bannerImages','totalBannerImages'));
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
            'site_favicon' => 'required|image|max:4096',
            'site_logo' => 'required|image|max:4096',
            'site_name' => 'required',
        ]);

        //dd(1);
                
        $checkForExist = ThemeOptions::where('user_id',auth()->user()->id)->first();
        
        if(!is_null($checkForExist) && ((!is_null($checkForExist->site_favicon) || !is_null($checkForExist->site_log))))
        {
            Alert::error('Delete old theme first','Alert');
            return back();            
        }
        elseif(!is_null($checkForExist) && ((is_null($checkForExist->site_favicon) || is_null($checkForExist->site_log))))
        {
            $themeOption = $checkForExist;            
        }
        else
        {
            $themeOption = new ThemeOptions();            
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

    public function saveDesign(Request $request)
    {        
        if(count($request->file()) > 0)
        {
            $request->validate([
                'banner_images.*' => 'image',                
            ]);
           
            $themeOption = ThemeOptions::where('user_id',auth()->user()->id)->first();

            $storePath = [];

            if(!is_null($themeOption->banner_images))
            {               
                $storePath = json_decode($themeOption->banner_images,true);                         
            }            

            foreach ($request->file('banner_images') as $key => $value)
            {                
                $image = $value;
                $imageName = time() . '_' . $image->getClientOriginalName();
                $destinationPath = 'images/banner_images/user_'.auth()->user()->id.'/';

                $pathDetail = $image->move(public_path($destinationPath), $imageName);

                $storePath[] = asset("/images/banner_images/user_".auth()->user()->id."/".$imageName);                                                                  
            }
            
            $themeOption->banner_images = json_encode($storePath);

            $themeOption->save();

            Alert::success('Saved successfully','Thank you');        
            return redirect()->back();
        }
        else
        {
            Alert::error('Choose at least one Banner Image','Sorry');
            return redirect()->back();
        }
    }

    public function resetDesign(Request $request)
    {
        $themeOption = ThemeOptions::where('user_id',auth()->user()->id)->first();

        if(!is_null($themeOption->banner_images))
        {
            $temp = json_decode($themeOption->banner_images,true);
            foreach($temp as $key => $value)
            {
                $list = explode('/', $value);
                $fileName = last($list);
                $path = public_path() . '/images/banner_images/user_'.auth()->user()->id.'/'.$fileName;
                
                if(file_exists($path)) {                    
                    unlink($path);              
                }
            }           
        }
        
        $themeOption->banner_images = NULL;
        $themeOption->menu_background = NULL;
        $themeOption->save();

        Alert::success('Theme design reset successfully','Thank you');
        
        return redirect()->route('themeoption.index');
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

   
    // public function edit($id)
    // {
    //     $viewObject = ThemeOptions::where('user_id',auth()->user()->id)->where('id',$id)->first();
    //     if(is_null($viewObject)){
    //         abort(404);
    //     }
    //     return view('themeoption.edit',compact('viewObject'));
    // }

   
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'site_name' => 'required',
    //         'site_favicon' => 'required|image|max:4096',
    //         'site_logo' => 'required|image|max:4096',
    //     ]);
        
    //     //$themeOption = ThemeOptions::findOrFail($id);
    //     $themeOption = ThemeOptions::where('id',$id)->where('user_id',auth()->user()->id)->first();
        
    //     if(is_null($themeOption))
    //     {
    //         abort(404);
    //     }

    //     $themeOption->site_name = $request->site_name;

    //     if ($request->hasFile('site_favicon'))
    //     {   
    //         if(!is_null($themeOption->site_favicon))
    //         {
    //             $temp = $themeOption->site_favicon;
    //             $list = explode('/', $temp);
    //             $fileName = last($list);
    //             // $path = public_path() . '/images/site_favicon/'.$fileName;
    //             $path = public_path('/images/site_favicon/'.$fileName);
    //             //dd($path);
    //             if(file_exists($path)) {
                    
    //                 if (is_file($path) && @unlink($path)) {
    //                     $deleteSiteFavicon = 1;
    //                 }else{
    //                     Alert::danger('Unable to Update Site Favicon Images','Sorry');
    //                 }
    //             }
    //         }         
            
    //         $image = $request->file('site_favicon');
    //         $imageName = time() . '_' . $image->getClientOriginalName();
    //         $destinationPath = 'images/site_favicon';
    //         $pathDetail = $image->move(public_path($destinationPath), $imageName);

    //         $storePath = asset("/images/site_favicon/".$imageName);                    

    //         $themeOption->site_favicon = $storePath;
    //     }

    //     if ($request->hasFile('site_logo'))
    //     {
    //         if(!is_null($themeOption->site_logo))
    //         {
    //             $temp = $themeOption->site_logo;
    //             $list = explode('/', $temp);
    //             $fileName = last($list);
    //             $path = public_path() . '/images/site_logo/'.$fileName;
    //             if(file_exists($path)) {
    //                 if(is_file($path) && @unlink($path)) {
    //                     $deleteSiteLogo = 1;
    //                 }else{
    //                     Alert::danger('Unable to Update Site Logo Images','Sorry');
    //                 };              
    //             }
    //         }

    //         $image = $request->file('site_logo');
    //         $imageName = time() . '_' . $image->getClientOriginalName();
    //         $destinationPath = 'images/site_logo';
    //         $pathDetail = $image->move(public_path($destinationPath), $imageName);

    //         $storePath = asset("/images/site_logo/".$imageName);                    

    //         $themeOption->site_logo = $storePath;
    //     }

    //     $themeOption->user_id = auth()->user()->id;

    //     $themeOption->save();

    //     Alert::success('Theme Option updated successfully','Thank you');
        
    //     return redirect()->route('themeoption.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        //$themeOption = ThemeOptions::findOrFail($id);
        $themeOption = ThemeOptions::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if(is_null($themeOption))
        {
            abort(404);
        }
                
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

        $themeOption->site_favicon = NULL;
        $themeOption->site_logo = NULL;
        $themeOption->site_name = NULL;
        $themeOption->save();

        Alert::success('Theme Option deleted successfully','Thank you');
        
        return redirect()->route('themeoption.index');
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = ThemeOptions::select('id','user_id','site_favicon','site_logo','site_name','created_at','updated_at')->where('user_id',auth()->user()->id)->get();

            if($data->count() == 0)
            {               
                $data = collect();
                return DataTables::of($data)->make(true);
            }
            elseif($data->count() > 0 && is_null($data[0]->site_favicon) && is_null($data[0]->site_logo))
            {
                $data = collect();                               
                return DataTables::of($data)->make(true);
            }

            $list = Datatables::of($data)->addIndexColumn()

                /*->editColumn('user', function($data) {
                    return $data->user->name;
                })*/

                ->editColumn('site_favicon', function($data) {
                    return '<a href="javascript:;" class="a-fancybox" data-fancybox="'.$data->site_favicon.'"><img src="'.$data->site_favicon.'" class="fancybox" height="40" width="40" /></a>';                    
                })
                ->editColumn('site_logo', function($data) {
                    return '<a href="javascript:;" class="a-fancybox" data-fancybox="'.$data->site_logo.'"><img src="'.$data->site_logo.'" class="fancybox" height="40" width="40" /></a>';                    
                }) 

                // ->editColumn('created', function($data) {
                //     return date('d M Y',strtotime($data->created_at));
                // })

                // ->editColumn('last_modified', function($data) {
                //     return date('d M Y',strtotime($data->updated_at));
                // })
                               
                ->addColumn('action', function($row){
                    $btn = '';
                    // $btn .= '<a href="'.route('themeoption.edit',$row->id).'" class="btn btn-primary btn-sm form-group"><i class="fa fa-edit"></i></a> ';
                    $btn .= '<a href="javascript:;" class="btn btn-danger btn-sm btn-delete form-group" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['site_favicon','site_logo'],['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
