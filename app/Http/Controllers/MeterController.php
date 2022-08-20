<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meter;
use App\Models\Carousel;
use Auth;
use App\Models\NewConnection;

class MeterController extends Controller
{
    public function Meters()
    {
        $carousel = Carousel::all();
        $user = Auth::id();
        $count = NewConnection::where('user_id',$user)->where('status',"=","confirmed")->count();
        $meters = Meter::where('status',"=","available")->orwhere('status',"=","processing")->get();


        if($count == 0){
            return redirect('/');
        }
        else{
            return view('Frontend.availablemeters',compact('meters','carousel','count'));
        }
      
    }

    public function adminview()
    {
        //Read

        $meters = Meter::all();
        return view('admin.meters',compact('meters'));
    }


    public function create()
    {
        //CREATE
        return view('admin.meter.create');
        
    }


    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            
            
        ]);
        
     
            $data = new Meter();
            $data->user_id = $request->user_id;
            $data->user_name = $request->user_name;
            $data->save();


        if($data->save()){
            //Redirect with Flash message
            return redirect('/admin/meter')->with('status', 'Meter added Successfully!');
        }
        else{
            return redirect('/admin/meter/create')->with('status', 'There was an error!');
        }

    }
}
