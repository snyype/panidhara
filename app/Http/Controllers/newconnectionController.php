<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\NewConnection;
use App\Models\Carousel;



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
    
    public function reqNewConnection()
    {
        $user=Auth::id();
        $data = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->count();
        $data2 = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->get();
        
        $carousel = Carousel::all();

        if($data != 0)
        {

           
            return view('Frontend.meterrequestform',compact('data2','carousel'));
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
        $data->save();


        if($data->save()){
            
            //Redirect with Flash message
            return redirect('/myrequests')->with('status', 'Requested Successfully!');
        }
        else{
            return redirect('/myrequests')->with('status', 'There was an error!');
        }
    

    }

    
}
