<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselController extends Controller
{
    

    public function index()
    {
        //Read

        $data = Carousel::all();
        // dd($posts);
        // $JSONfile = json_encode($posts);
        // dd($JSONfile);
        return view('admin.carousel',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //CREATE
        return view('admin.carousel.create');
        
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
          
            'gallery' => 'required',
            
            
        ]);
        
        if ($file = $request->file('gallery')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('gallery');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = time().".".$imgExt;
            $result = $image->storeAs('images/carousel',$fullname);
            }
    
            else{
                $fullname = 'image.png';
            }

            $data = new Carousel();
            $data->name = $request->name;
            $data->desc = $request->desc;
            $data->gallery = $fullname;
            $data->save();

        if($data->save()){
            //Redirect with Flash message
            return redirect('/admin/carousel')->with('status', 'Carousel added Successfully!');
        }
        else{
            return redirect('/admin/carousel/create')->with('status', 'There was an error!');
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
        $data = Carousel::where('id',$id)->first();
        return view('admin.carousel.show',compact('data'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Update View
        
        $data = Carousel::where('id',$id)->first();
        return view('admin.carousel.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Carousel::find($id);
        if ($file = $request->file('gallery')) {
            $request->validate([
                'image' =>'mimes:jpg,jpeg,png,bmp'
            ]);
            $image = $request->file('gallery');
            $imgExt = $image->getClientOriginalExtension();
            $fullname = time().".".$imgExt;
            $result = $image->storeAs('images/carousel',$fullname);
            }
    
            else{
                $fullname = $data->gallery;
            }
        //Update
       
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->gallery = $fullname;
        

        if($data->save()){
            return redirect('/admin/carousel')->with('status', 'Carousel updated successfully!');
        }
        else{
            return redirect('/admin/carousel/$id/edit')->with('status', 'There was an error');

        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete
        $data = Carousel::find($id);
        if($data->delete()){
            return redirect('/admin/carousel')->with('status', 'Carousel was deleted successfully');
        }
        else return redirect('/admin/carousel')->with('status', 'There was an error');

        
    }

}
