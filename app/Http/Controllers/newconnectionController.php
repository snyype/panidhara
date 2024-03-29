<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NewConnection;
use App\Models\Notification;
use App\Models\Carousel;
use App\Models\Meter;
use App\Models\User;



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

        if (auth()->check()){
            $user=Auth::id();
            $data = NewConnection::where('user_id',$user)->where('status','=','confirmed')->count();
            $data2 = NewConnection::where('user_id',$user)->where('status','=','confirmed')->get();
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
        else{
            return redirect('/login');
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
            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "Request For New Connection Submitted";
            $notification->save();

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

    public function UpdatConnStatus($id, $user_id)
    {

        $data = NewConnection::find($id);
        $data->status = 'confirmed';

        $data->save();

        if($data->save())
        {

            
            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You (Admin) changed $data->name's connection request status to confirmed";
            $notification->save();


            $uid= $user_id;
            $usernotification = new Notification();
            $usernotification->user_id = $uid;
            $usernotification->message = "Admin confirmed your request / Goto myrequest to purchase a meter";
            $usernotification->save();

            return redirect('/admin/confirmedconnectionrequest');
        }
        else{
            return redirect('/admin/confirmedconnectionrequest');
        }

    }

    public function ChangeToPending($id, $user_id)
    {
       
        $data = NewConnection::find($id);
        $data->status = 'pending';

        $data->save();

        if($data->save())
        {

            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You (Admin) reverted $data->name's connection request Status to Pending";
            $notification->save();


            $uid= $user_id;
            $usernotification = new Notification();
            $usernotification->user_id = $uid;
            $usernotification->message = "Admin confirmed your request / Goto myrequest to purchase a meter";
            $usernotification->save();


            return redirect('/admin/connectionrequest');
        }

    }

    
}
