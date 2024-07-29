<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function getList(Request $request)
    {        
        if ($request->ajax()) {
            $data = User::select('id','name','email','phone','gender','deleted_at')
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
                        $btn = '<a href="javascript:;" class="btn btn-success btn-sm btn-blockunblock-user" data-id="'.$row->id.'" data-status="block" title="Block User"><i class="fa fa-unlock"></i></a> ';    
                    }
                    elseif(!is_null($row->deleted_at))
                    {
                        $btn = '<a href="javascript:;" class="btn btn-danger btn-sm btn-blockunblock-user" data-id="'.$row->id.'" data-status="unblock" title="UnBlock User"><i class="fa fa-lock"></i></a> ';       
                    }
                    

                    $btn .= '<a href="javascript:;" class="btn btn-primary btn-sm btn-reset-password"  data-id="'.$row->id.'" title="Reset Password"><i class="fa fa-key"></i></a>';

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
        $user->save();

        Alert::success('Password Reset Successfully','Thank you');
        return redirect()->back();
    }
}
