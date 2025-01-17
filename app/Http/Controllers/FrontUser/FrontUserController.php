<?php

namespace App\Http\Controllers\FrontUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Properties;
use App\Models\Pages;
use App\Models\Footer;
use App\Models\FooterDetail;
use App\Models\PropertyOptions;
use App\Models\PropertyCategory;
use App\Models\PropertyPrice;

class FrontUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = NULL)
    {
        $user = User::where('slug',$slug)->first();

        if(is_null($user))
        {
            abort(404);
        }

        $pages = Pages::where('user_id',$user->id)->where('parent_id','0')->get();

        $footer = FooterDetail::where('user_id',$user->id)->orderBy('footer_id')->get();

        //$propertyOption = PropertyOptions::pluck('option_name','id')->toArray();
            
        $propertyOption = Properties::select('option_id')->where('user_id',$user->id)->groupBy('option_id')->get();

        $propertyCategory = Properties::select('category_id')->where('user_id',$user->id)->groupBy('category_id')->get();

        
        $propertyPrice = Properties::select('price_id')->where('user_id',$user->id)->groupBy('price_id')->get();
        
        return view('front.index',compact('slug','user','pages','footer','propertyOption','propertyCategory','propertyPrice'));
    }

    public function functionPage()
    {
        dd(1);
    }

    public function getFrontUserDetail($slug)
    {
        $user = User::where('slug',$slug)->first();
        if(is_null($user))
        {
            abort(404);
        }

        $property = Properties::where('user_id',$user->id)->get();

        $data['user'] = $user;
        $data['property'] = $property;

        return $data;        
    }

    public function home($slug = NULL)
    {        
        $data = $this->getFrontUserDetail($slug);

        $user = $data['user'];
        $property = $data['property'];
        $activeMenu = 'home';

        return view('front.index',compact('user','property','activeMenu'));
    }

    public function service($slug = NULL)
    {  
        $data = $this->getFrontUserDetail($slug);

        $user = $data['user'];
        $property = $data['property'];
        $activeMenu = 'service';

        return view('front.service',compact('user','property','activeMenu'));
    }

    public function about($slug = NULL)
    {   
        $data = $this->getFrontUserDetail($slug);

        $user = $data['user'];
        $property = $data['property'];
        $activeMenu = 'about';

        return view('front.about',compact('user','property','activeMenu'));
    }

    public function contactUs($slug = NULL)
    {   
        $data = $this->getFrontUserDetail($slug);

        $user = $data['user'];
        $property = $data['property'];
        $activeMenu = 'contactus';
            
        return view('front.contactus',compact('user','property','activeMenu'));
    }    

    public function filterImage(Request $request)
    {
        //dd($request->all());

        if($request->ajax())
        {
            $user = User::where('slug',$request->slug)->first();

            if(is_null($user))
            {
                abort(404);
            }

            $option_id = $request->option_id;
            $category_id = $request->category_id;
            $price_id = $request->price_id;
            $conditionFlag = 0;

            //dd($option_id,$category_id,$price_id);

            $query = Properties::where('user_id',$user->id);

            if(!is_null($option_id))
            {
                $conditionFlag = 1;
                $query->where('option_id',$option_id);
            }
            

            if(!is_null($category_id))
            {
                $conditionFlag = 1;
                $query->where('category_id',$category_id);    
            }
            

            if(!is_null($price_id))
            {
                $conditionFlag = 1;
                
                $query->where("price_id",$price_id);

            }

            if($conditionFlag == 1)
            {
                $data = $query->get();
            }
            else
            {
                $data = collect([]);
            }
        
            return view('front.filter_property_images',compact('data'));
        }
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
        //
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
}
