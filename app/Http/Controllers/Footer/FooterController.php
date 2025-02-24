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
        $userId = auth()->user()->id;
        $footerHeadings = Footer::where('user_id',$userId)->get();
        
        return view('footer.index',compact('footerHeadings'));       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function viewFooterDetail(Request $request)
    {
        $footer_id = $request->footer_id;
        $footerDetail = Footer::where('id',$footer_id)->first();        
        return view('footer.footer_detail',compact('footerDetail'));
    }

   public function saveFooterDetail(Request $request)
   {        
        $footer_id = $request->footer_id;
        $saveData = $request->except(['_token','footer_id']);
        Footer::where('id',$footer_id)->update($saveData);
        Alert::success('Saved successfully','Thank you');
        return redirect()->route('footer.index');
   }

    public function createFooter()
    {
        $checkForExist = Footer::where('user_id',auth()->user()->id)->count();

        if($checkForExist != 0)
        {
            return back();
        }

        $toatlHeading = Footer::FOOTER_TOTAL_HEADING;
        $userId = auth()->user()->id;
        
        for($numBer=1; $numBer <= $toatlHeading; $numBer++)
        {
            $newRow = new Footer();
            $newRow->user_id = $userId;
            $newRow->save();
        }
       
        Alert::success('Footer created successfully','Thank you');
        return redirect()->route('footer.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveFooterHeading(Request $request)
    {
        $footerHeading = $request->footerHeading;
        foreach($footerHeading as $key => $value)
        {
            $filterValue = $value;
            Footer::where('id',$key)->update(['footer_heading' => $filterValue]);
        }
        Alert::success('Saved successfully','Thank you');
        return redirect()->route('footer.index');
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
