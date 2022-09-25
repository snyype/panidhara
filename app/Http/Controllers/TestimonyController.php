<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
use Illuminate\Support\Facades\Auth;

class TestimonyController extends Controller
{
    

    public function index()
    {
        $data=Testimony::all();
        return view('admin.testimony',compact('data'));


    }
    public function create()
    {
        //CREATE
        return view('admin.testimony.create');
        
    }
    public function createsecond()
    {
       
        $user = Auth::user();
            if ($user== NULL) {
                return redirect('/login');
            }
            else {
                return view("testimonial");
            }
        
    }

    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'subject' => 'required',
            'image' => 'required',
            
        ]);
        
        if ($file = $request->file('image')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('image');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = time().".".$imgExt;
            $result = $image->storeAs('images/testimony',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }

            $data = new Testimony();
            $data->name = $request->name;
            $data->desc = $request->desc;
            $data->subject = $request->subject;
            $data->image = $fullname;
            $data->save();

        if($data->save()){
            //Redirect with Flash message
            return redirect('/admin/testimony')->with('status', 'Testimony added Successfully!');
        }
        else{
            return redirect('/admin/testimony/create')->with('status', 'There was an error!');
        }

    }

    public function storesecond(Request $request)
    {
        //CREATE
        
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'subject' => 'required',
            'image' => 'required',
            
        ]);
        
        if ($file = $request->file('image')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('image');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = time().".".$imgExt;
            $result = $image->storeAs('images/testimony',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }

            $data = new Testimony();
            $data->name = $request->name;
            $data->desc = $request->desc;
            $data->subject = $request->subject;
            $data->image = $fullname;
            $data->save();

        if($data->save()){
            
            return redirect('/')->with('status', 'Testimony added Successfully!');
        }
        else{
            return redirect('/')->with('status', 'There was an error!');
        }

    }

    public function edit($id)
    {
        //Update View
        
        $data = Testimony::where('id',$id)->first();
        return view('admin.testimony.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Testimony::find($id);
        if ($file = $request->file('image')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('image');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = time().".".$imgExt;
            $result = $image->storeAs('images/tanker',$fullname);
            }
    
            else{
                $fullname = $data->image;
            }

        //Update
        $data = Testimony::find($id);
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->subject = $request->subject;
        $data->status = $request->status;
        $data->image=$fullname;

        if($data->save()){
            return redirect('/admin/testimony')->with('status', 'Tanker updated Successfully!');
        }
        else{
            return redirect('/admin/testimony/$id/edit')->with('status', 'There was an error');

        }
        //
    }


}
