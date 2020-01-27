<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\positions;
use App\master;

class MasterController extends Controller
{
    //
    public function PositionInput()
    {
        
        return view('positioninput');
    }
    public function insertPosition(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'position' => 'required',
            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $position = new Position();
        $position ->position = $request->position;
        
        $position->save();
        return rediret('/home');
    }
    //CRUD Position
    public function deletePosition($id)
    {
        Insert::destroy($id);
        return redirect('/view');
    }
    public function viewdelPosition()
    {
        $position = positions::paginate(8);
        return view('viewdelPosition',compact('position'));
    }

    public function viewupPosition()
    {
        $position = positions::paginate(8);
        return view('viewupPosition',compact('position'));
    }
    public function updPosition($id)
    {
        $position = positions::find($id);
        return view('updatePosition',compact('position'));
    }
    public function doUpdatePosition(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'position' => 'required',

            ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $position = positions::find($request->id);
        $position->position = $request->position;
        $position->save();
        return back();
    }
    public function AddData(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'prefix' => 'required',
                'text1'=>'required',
             

            ]);
        if($validator->fails())
        {
            return back()->withErrors($validator);
        }

        $masterdata = new master();
        $masterdata->prefix = $request->prefix;
        $masterdata->text1 = $request->text1;
        $masterdata->save();
        return back();
    }

    public function ViewFormMaster()
    {
        return view('MasterDataInput');
    }

}
