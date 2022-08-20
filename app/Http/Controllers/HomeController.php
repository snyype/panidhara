<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carousel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function UserDetails()
    {
        $user_details=User::all();
        $carousel = Carousel::all();
        return view('Frontend.profile',compact('user_details','carousel'));
    }

    function update(Request $request, $id)
    {
        //Update

   

        $data = User::find($id);

        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'citizenship_number' => 'required',
            'house_number' => 'required',
            'address' => 'required'
            

        ]);

        if ($file = $request->file('gallery')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('gallery');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = "Profile".time().".".$imgExt;
            $result = $image->storeAs('images/users',$fullname);
            }
    
            else{
                $fullname = $data->gallery;
            }

        if ($file = $request->file('gallery2')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('gallery2');
            $imgExt = $image->getClientOriginalExtension();
            $fullname2 = "citfront".time().".".$imgExt;
            $result = $image->storeAs('images/users',$fullname2);
            }
    
            else{
                $fullname2 = $data->gallery2;
            }

        if ($file = $request->file('gallery3')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('gallery3');
            $imgExt = $image->getClientOriginalExtension();
            $fullname3 = "citback".time().".".$imgExt;
            $result = $image->storeAs('images/users',$fullname3);
            }
    
            else{
                $fullname3 = $data->gallery3;
            }

        
            

        
   
        $data->name = $request->name;
        $data->number = $request->number;
        $data->citizenship_number = $request->citizenship_number;
        $data->house_number = $request->house_number;
        $data->address =$request->address;
        $data->gallery = $fullname;
        $data->gallery2 = $fullname2;
        $data->gallery3 = $fullname3;
        $data->save();


       
       

        if($data->save()){
            return redirect('/user')->with('status', 'User Updated Successfully!');
        }
        else{
            return redirect('/usser')->with('status', 'There was an error');

        }
        //
    }

    
}
