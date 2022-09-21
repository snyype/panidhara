<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\NewConnection;
use App\Models\Carousel;
use App\Models\Meter;



class newconnectionController extends Controller
{
    public function RequestConnection()
    {
        $user = Auth::user();
        
        if ($user== NULL) {
            return redirect('/login');
        }
        else {
            return redirect("/request-new-connection");
        }
        

        
    }
    
    public function reqNewConnection($id)
    {
        $user=Auth::id();
        $data = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->count();
        $data2 = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->get();
        $data3 = Meter::find($id);

        $carousel = Carousel::all();
        
        


        if($data != 0)
        {

           
            return view('Frontend.meterrequestform',compact('data2','carousel','data3'));
        }
        else{
            return redirect('/');
        }

       

        
    }
    


    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());

        
        $request->validate([
            'user_name' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'citizenship_number' => 'required',
            'house_number' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'number' => 'required',
            
            
        ]);

        $data = new NewConnection();
        $data->user_name = $request->user_name;
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->number = $request->number;
        $data->citizenship_number = $request->citizenship_number;
        $data->house_number = $request->house_number;
        $data->latitude = $request->lat;
        $data->longitude = $request->lng;
        $data->save();


        if($data->save()){
            
            //Redirect with Flash message
            return redirect('/myrequests')->with('status', 'Requested Successfully!');
        }
        else{
            return redirect('/request-new-connection')->with('status', 'There was an error!');
        }
    

    }

    public function ShowNewConn()
    {
       
        $data = NewConnection::where('status','pending')->get();

        return view('admin.manageconnection.allconnectionreq',compact('data'));
    }

    public function ShowConfirmedConn()
    {
       
        $data = NewConnection::where('status','confirmed')->get();

        return view('admin.manageconnection.acceptedreq',compact('data'));
    }

    public function UpdatConnStatus($id)
    {

        $data = NewConnection::find($id);
        $data->status = 'confirmed';

        $data->save();

        if($data->save())
        {
            return redirect('/admin/connectionrequest');
        }

    }

    
}
