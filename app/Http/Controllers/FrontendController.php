<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Carousel;
use App\Models\Testimony;
use App\Models\Notification;
use App\Models\NewConnection;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $carousel = Carousel::all();
        $testimony = Testimony::where('status','=','confirmed')->get();
        $myreqcount = NewConnection::where('user_id',$user_id)->count();
        $myreq = NewConnection::where('user_id',$user_id)->first();
        return view('Frontend.homepage',compact('myreqcount','carousel','testimony','myreq'));
    }

    public function newConnection()
    {
        $user = Auth::id();
        $carousel = Carousel::all();
        $count = NewConnection::where('user_id',$user)->count();
        $countconfirmation = NewConnection::where('user_id',$user)->where('status','confirmed')->count();

        return view('Frontend.newconnection',compact('count','carousel','countconfirmation'));
    }

       
    

    public function RequestANewMeter()
    {
        $carousel = Carousel::all();
        return view('Frontend.availablemeters',compact('carousel'));
    }

    public function myRequests()
    {
        $user = Auth::id();
        $carousel = Carousel::all();
        $myrequests = NewConnection::where('user_id', $user)->get();

        if($myrequests)
        {
           
            return view('Frontend.myrequests',compact('myrequests','carousel'));
        }
        else{
            $myrequests = "";
           
        }
        
       
    

       
    }
    

    public function dashboard()
    {
        //Read
        
       
        
        return view('admin.dashboard');
       
    }
    public function CheckStatus()
    {
        
        return view('admin.dashboard');
       
    }
    public function NotificationActions()
    {
        $carousel = Carousel::all();
        $data = Notification::where('user_id', auth()->user()->id)->where('is_opened', false)->orderBy('id', 'DESC')->get();
       


        return view('Frontend.notifications',compact('data','carousel'));
       
    }
  
    public function NotificationRead()
    {
       
        $data = Notification::where('is_opened', true)->get();
       
        if($data){

            $carousel = Carousel::all();
            Notification::where('created_at','<', Carbon::now()->subMinute(2))->delete();


            return view('Frontend.notifications',compact('data','carousel'));

        }
        else{
            $data = [];
            $carousel = Carousel::all();
            return view('Frontend.notifications',compact('carousel'));
        }


        
       
    }
  


   
}
