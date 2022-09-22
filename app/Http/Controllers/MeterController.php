<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meter;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use App\Models\NewConnection;
use App\Models\Maintanance;

class MeterController extends Controller
{
    public function Meters()
    {
        $carousel = Carousel::all();
        $user = Auth::id();
        $count = NewConnection::where('user_id',$user)->where('status',"=","confirmed")->count();
        $meter = 
        $meters = Meter::where('status',"=","available")->orwhere('status',"=","processing")->orwhere('status',"=",'Booked')->get();


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
            'name' => 'required | unique:meters,name',
            
        ]);
        
     
            $data = new Meter();
            $data->name = $request->name;
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

    public function update(Request $request, $id)
    {
       
       
        //Update
        $data = Meter::find($id);
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->user_name = $request->user_name;
        $data->status = $request->status;
        $data->unit = $request->unit;
        $data->save();

        if($data->save()){
            return redirect('/admin/meter')->with('status', 'Meter updated Successfully!');
        }
        else{
            return redirect('/admin/meter/$id/edit')->with('status', 'There was an error');

        }
        //
    }


    public function purchasemeter($id)
    {
        $user = Auth::id();
        $user2 = auth()->user();
        $data = Meter::find($id);
        $data->user_id = $user;
        $data->user_name = $user2->name;
        $data->status = "Booked";
        $data->save();

        if($data->save()){
            return redirect('/admin/meter');
        }


    }

    public function edit($id)
    {
        //Update View
        
        $data = Meter::where('id',$id)->first();
        return view('admin.meter.edit',compact('data'));
    }


    public function destroy($id)
    {
        //Delete
        $data = Meter::find($id);
        if($data->delete()){
            return redirect('/admin/meter')->with('status', 'Meter was deleted successfully');
        }
        else return redirect('/admin/meter')->with('status', 'There was an error');

        
    }

    public function maintanance()
    {
        $carousel = Carousel::all();
        return view('Frontend.maintainance',compact('carousel'));
    }

    public function storemaintainance(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            
            
        ]);
        
     
            $data = new Maintanance();
            $data->user_id = $request->user_id;
            $data->user_name = $request->user_name;
            $data->comment = $request->comment;
            $data->house_number = $request->house_number;
            $data->date = $request->date;
            $data->latitude = $request->lat;
            $data->longitude = $request->lng;
            $data->save();


        if($data->save()){
            //Redirect with Flash message
            return redirect('/admin/maintanance')->with('status', 'Meter added Successfully!');
        }
        else{
            return redirect('/admin/meter/create')->with('status', 'There was an error!');
        }

    }


    public function maintananceview()
    {
        $data = Maintanance::all();


        return view('admin.maintanance.maintanance',compact('data'));
    }


    public function Viewmap($id)
    {
        
        $data = Maintanance::find($id);

        return view('admin.maintanance.viewmap',compact('data'));
    }

    public function ViewConnectionMap($id)
    {
        
        $data = NewConnection::find($id);

        return view('admin.maintanance.viewconnectionmap',compact('data'));
    }
}
