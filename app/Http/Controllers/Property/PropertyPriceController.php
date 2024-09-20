<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyPrice;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;


class PropertyPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('property.add_property_price');
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
            'min_price' => 'required',
            'max_price' => 'required',
        ]);
         
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $price = $min_price.' to '.$max_price;

        $propertyPrice = new PropertyPrice();

        $propertyPrice->user_id = auth()->user()->id;
        $propertyPrice->price = $price;
        $propertyPrice->min_price = $min_price;
        $propertyPrice->max_price = $max_price;        

        $propertyPrice->save();

        Alert::success('Property Price saved successfully','Thank you');
        
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
        $propertyPrice = PropertyPrice::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if(is_null($propertyPrice))
        {
            abort(404);
        }
        return view('property.edit_property_price',compact('propertyPrice'));
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
            'min_price' => 'required',
            'max_price' => 'required',
        ]);

        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $price = $min_price.' to '.$max_price;

        $row = [
                'price' => $price,
                'min_price' => $min_price,
                'max_price' => $max_price
                ];

        PropertyPrice::where('id',$id)->where('user_id',auth()->user()->id)->update($row);

        Alert::success('Property Price saved successfully','Thank you');    
        return redirect()->route('propertyprice.index');
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
            
            $data = PropertyPrice::where('user_id',auth()->user()->id)->get();
            
            $list = Datatables::of($data)->addIndexColumn()

                
                ->editColumn('created', function($data) {
                    return date('d M Y',strtotime($data->created_at));
                })

                ->editColumn('last_modified', function($data) {
                    return date('d M Y',strtotime($data->updated_at));
                })
                               
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('propertyprice.edit',$row->id).'" class="btn btn-primary btn-sm form-group"><i class="fa fa-edit"></i></a> ';                    
                    return $btn;
                })
                ->rawColumns(['action'])                
                ->addIndexColumn()                
                ->make(true);

            return $list;
        }
    }
}
