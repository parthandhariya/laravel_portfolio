<?php

namespace App\Http\Controllers\Footer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Footer;
use App\Models\FooterDetail;
use RealRashid\SweetAlert\Facades\Alert;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerHeading = Footer::get();
        $footerDetail = [];
        return view('footer.index',compact('footerHeading','footerDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function viewFooterDetail(Request $request)
    {
        $footerHeading = Footer::get();

        $checkId = Footer::where('id',$request->footer_heading_id)->first();
        if(is_null($checkId))
        {
            abort(404);
        } 

        $footerDetail = FooterDetail::where('user_id',auth()->user()->id)->where('footer_id',$checkId->id)->first();

        if(is_null($footerDetail))
        {
            $footerDetail = new FooterDetail();
            $footerDetail->user_id = auth()->user()->id;
            $footerDetail->footer_id = $checkId->id;
            $footerDetail->save();
        }

        return view('footer.index',compact('footerDetail','footerHeading'));
    }

    public function updateFooterDetail(Request $request)
    {
        //dd($request->all());
        $userId = $request->user_id;
        $footerId = $request->footer_id;

        $footerLines = [

            'line1' => $request->line1,
            'line2' => $request->line2,
            'line3' => $request->line3,
            'line4' => $request->line4,
            'line5' => $request->line5,

        ];

        //dd($footerLines);

        FooterDetail::where(['user_id'=>$userId,'footer_id'=>$footerId])->update($footerLines);


        Alert::success('Footer detail saved successfully','Thank you');
        
        return back();

    }

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
