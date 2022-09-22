<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NewConnection;
use App\Models\Carousel;
use App\Models\Testimony;

class FrontendController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $carousel = Carousel::all();
        $testimony = Testimony::where('status','=','confirmed')->get();
        $myreqcount = NewConnection::where('user_id',$user_id)->count();
        return view('Frontend.homepage',compact('myreqcount','carousel','testimony'));
    }

    public function newConnection()
    {
        $user = Auth::id();
        $carousel = Carousel::all();
        $data2 = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->get();

        return view('Frontend.newconnection',compact('data2','carousel'));
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
    public function thnakyou()
    {
        

    
        
        return view('thankyou');
       
    }


   
}
