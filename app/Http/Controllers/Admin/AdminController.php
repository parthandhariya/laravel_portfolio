<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Footer;
use App\Models\Pages;
use App\Models\Properties;
use App\Models\PropertyCategory;
use App\Models\PropertyDetail;
use App\Models\PropertyPrice;
use App\Models\ThemeOptions;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.all_users');
    }

    public function home()
    {       
        return view('admin.home');        
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

    public function resetTable($table = NULL)
    {
        if($table::count() > 0)
        {
            $table::truncate();
        }
    }

    public function getTableName()
    {
        $tableNames = [
            "App\Models\Footer",
            "App\Models\Pages",
            "App\Models\Properties",
            "App\Models\PropertyCategory",
            "App\Models\PropertyDetail",
            "App\Models\PropertyPrice",
            "App\Models\ThemeOptions",
            "App\Models\User",
        ];

        return $tableNames;
    }
    
    public function removeFolder($folderPath)
    {
        $fullPath = public_path($folderPath);
        if (File::exists($fullPath)) {
            File::deleteDirectory($fullPath);                        
        }
    }

    public function getFolderPath()
    {
        $folderPath = [
            "images/site_favicon",
            "images/site_logo",
            "images/banner_images",
            "images/property_images",            
        ];

        return $folderPath;
    }

    public function factoryReset(Request $request)
    {         
        if(auth()->user()->user_type == "admin")
        {
            try{
               
                $tableNames = $this->getTableName();
                foreach($tableNames as $key => $value)
                {
                    $this->resetTable($value);
                }

                $user = User::create([
                    'name' => "Parth Andhariya",
                    'email' => "pjandharia@gmail.com",
                    'phone' => "8866269039",                    
                    'password' => \Hash::make(123),
                    'vpassword' => 123,
                    'user_type' => "admin",
                ]);
                
                $folderPath = $this->getFolderPath();
                foreach($folderPath as $key => $value)
                {
                    $this->removeFolder($value);                    
                }                
                
            }   catch (\Exception $e) {
                //DB::rollBack(); // Rollback the transaction on error
                Alert::warning('Something went wrong, System can not be Reset','Sorry');
                return redirect()->back();
            }
            
            Alert::success('System Reset Successfully','Thank you');
            return redirect()->route('logout');
        }
        else
        {            
            return redirect()->route('logout');
        }        
    }

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = User::select('id','name','email','phone','gender','vpassword','slug','deleted_at')
                    ->where('user_type','user')
                    ->withTrashed()
                    ->get();
            

            $list = Datatables::of($data)->addIndexColumn()

                ->editColumn('name', function($data) {
                    return $data->name;
                })
                ->editColumn('email', function($data) {
                    return $data->email;                    
                })

                ->editColumn('phone', function($data) {
                    return $data->phone;
                })

                ->editColumn('gender', function($data) {
                    return $data->gender;
                })
                
                ->addColumn('action', function($row){
                    
                    if(is_null($row->deleted_at))
                    {
                        $btn = '<a href="javascript:;" class="btn btn-success btn-sm btn-blockunblock-user form-group" data-id="'.$row->id.'" data-status="block" title="Block User"><i class="fa fa-unlock"></i></a> ';    
                    }
                    elseif(!is_null($row->deleted_at))
                    {
                        $btn = '<a href="javascript:;" class="btn btn-danger btn-sm btn-blockunblock-user form-group" data-id="'.$row->id.'" data-status="unblock" title="UnBlock User"><i class="fa fa-lock"></i></a> ';       
                    }
                    

                    $btn .= '<a href="javascript:;" class="mr-1 btn btn-info btn-sm btn-reset-password form-group"  data-id="'.$row->id.'" title="Reset Password"><i class="fa fa-key"></i></a>';

                    $btn .= '<a href="'.route('frontend',"$row->slug").'" class="btn btn-success btn-sm form-group" title="Preview Website" target="_blank"><i class="fa fa-eye"></i></a>';                    

                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }

    public function blockUnblockUser(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
    
        if($status == "block")
        {
            $updateUser = User::findOrFail($id)->delete();            
            $message = "User Blocked Successfully";
        }
        else
        {
            $updateUser = User::withTrashed()->findOrFail($id)->restore();            
            $message = "User UnBlocked Successfully";
        }

        Alert::success($message,'Thank you');
        return redirect()->back();
    }

    public function resetUserPassword(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);

        $user->password = \Hash::make(123456);
        $user->vpassword = 123456;
        $user->save();

        Alert::success('Password Reset Successfully','Thank you');
        return redirect()->back();
    }
}
