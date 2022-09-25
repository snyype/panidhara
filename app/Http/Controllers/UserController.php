<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class UserController extends Controller
{
   public $search;

    public function index()
    {
        //Read

        $searchword = '%'.$this->search.'%';
        $data = User::where('name','LIKE',$searchword)
        ->orwhere('email','LIKE',$searchword)
        ->orwhere('verified','LIKE',$searchword)
        ->orwhere('role','LIKE',$searchword)
        ->orderBy('id','ASC')->get();
        return view('admin.userstable',compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //CREATE
        return view('admin.user.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            'name' => ['required'],
            'email' => ['required',],
            'password' => ['required'],
            'role' => ['required'],
            'verified' => ['required']
            
        ]);
        

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' =>$request->role,
            'verified' =>$request->verified
            
        ]);

        if($data){
            //Redirect with Flash message
            return redirect('/admin/userstable')->with('status', 'User created Successfully!');
        }
        else{
            return redirect('/admin/userstable/create')->with('error', 'There was an error!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Read individual
        // $posts = Post::find(3)->get();
        $data = User::where('id',$id)->first();
        return view('admin.user.show',compact('data'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function edit($id)
    {
        //Update View
        $data = User::where('id',$id)->first();
        return view('admin.user.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
function update(Request $request, $id)
    {
        //Update
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->role =$request->role;
        $data->verified =$request->verified;
        $data->house_number =$request->house_number;
        $data->citizenship_number =$request->citizenship_number;
        $data->number =$request->number;

       
       

        if($data->save()){
            return redirect('/admin/userstable')->with('status', 'User Updated Successfully!');
        }
        else{
            return redirect('/admin/userstable/$id/edit')->with('status', 'There was an error');

        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function destroy($id)
    {
        //Delete
        $data = User::find($id);
        if($data->delete()){
            return redirect('/admin/userstable')->with('status', 'User was deleted successfully');
        }
        else return redirect('/admin/userstable')->with('status', 'There was an error');

        
    }

}
