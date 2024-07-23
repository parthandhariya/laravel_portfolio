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
            $data = User::select('id','name','email','phone','gender')
                    ->where('user_type','user')
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
                    $btn = '<a href="javascript:;" class="btn btn-danger btn-sm"><i class="fa fa-lock"></i></a> ';
                    $btn .= '<a href="javascript:;" class="btn btn-primary btn-sm"><i class="fa fa-key"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
