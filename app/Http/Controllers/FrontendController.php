<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\NewConnection;
use App\Models\Carousel;

class FrontendController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $carousel = Carousel::all();
        $myreqcount = NewConnection::where('user_id',$user_id)->count();
        return view('Frontend.homepage',compact('myreqcount','carousel'));
    }

    public function newConnection()
    {
        $user = Auth::id();
        $carousel = Carousel::all();
        $data2 = NewConnection::where('user_id',$user)->orwhere('status','=','confirmed')->get();

        return view('Frontend.newconnection');
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
        $myrequests = NewConnection::where('user_id', $user)->take(1)->get();
       
    

        return view('Frontend.myrequests',compact('myrequests','carousel'));
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
}
