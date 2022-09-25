<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meter;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use App\Models\NewConnection;
use App\Models\Maintanance;
use App\Models\Notification;
use App\Models\Transaction;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MeterController extends Controller
{
    public function Meters()
    {
        $carousel = Carousel::all();
        $user = Auth::id();
        $count = NewConnection::where('user_id',$user)->where('status',"=","confirmed")->count();
        $metercount = Meter::where('user_id', auth()->user()->id)->count();
        $meters = Meter::where('status',"=","available")->orwhere('status',"=","processing")->orwhere('status',"=",'Booked')->get();


        if($count == 0){
            return redirect('/');
        }
        else{
            return view('Frontend.availablemeters',compact('meters','carousel','count','metercount'));
        }
      
    }

    public function adminview()
    {
        //Read

        $meters = Meter::all();
        return view('admin.meters',compact('meters'));
    }


    public function create()
    {
        //CREATE
        return view('admin.meter.create');
        
    }


    public function store(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            'name' => 'required | unique:meters,name',
            
        ]);
        
     
            $data = new Meter();
            $data->name = $request->name;
            $data->meter_number = uniqid();
            $data->user_id = $request->user_id;
            $data->user_name = $request->user_name;
            $data->save();


        if($data->save()){
            //Redirect with Flash message

            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You (Admin) Added $data->name successfully";
            $notification->save();

            return redirect('/admin/meter')->with('status', 'Meter added Successfully!');
        }
        else{
            return redirect('/admin/meter/create')->with('status', 'There was an error!');
        }

    }

    public function update(Request $request, $id)
    {
       
       
        //Update
        $data = Meter::find($id);
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->user_name = $request->user_name;
        $data->status = $request->status;
        $data->unit = $request->unit;
        $data->due_amount = $request->unit*15;
        $data->updated_at = now();
        $data->save();

        if($data->save()){

            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You (Admin) updated $data->name successfully";
            $notification->save();

            return redirect('/admin/meter')->with('status', 'Meter updated Successfully!');
        }
        else{
            return redirect('/admin/meter/$id/edit')->with('status', 'There was an error');

        }
        //
    }


    public function purchasemeter($id)
    {
        $user = Auth::id();
        $user2 = auth()->user();
        $data = Meter::find($id);
        $data->user_id = $user;
        $data->user_name = $user2->name;
        $data->status = "Booked";
        $data->save();

        if($data->save()){
            return redirect('/mymeter');
        }


    }

    public function edit($id)
    {
        //Update View
        
        $data = Meter::where('id',$id)->first();
        return view('admin.meter.edit',compact('data'));
    }


    public function destroy($id)
    {
        //Delete
        $data = Meter::find($id);
        if($data->delete()){

            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You (Admin) deleted $data->name successfully";
            $notification->save();

            return redirect('/admin/meter')->with('status', 'Meter was deleted successfully');
        }
        else return redirect('/admin/meter')->with('status', 'There was an error');

        
    }

    public function maintanance()
    {
        $carousel = Carousel::all();
        $count = Maintanance::where('user_id', auth()->user()->id)->count();
        $data = Maintanance::where('user_id', auth()->user()->id)->get();
        return view('Frontend.maintainance',compact('carousel','count','data'));
    }

    public function storemaintainance(Request $request)
    {
        //CREATE
        // dd($request->all());
        $request->validate([
            
            
        ]);
        
     
            $data = new Maintanance();
            $data->user_id = $request->user_id;
            $data->user_name = $request->user_name;
            $data->comment = $request->comment;
            $data->house_number = $request->house_number;
            $data->date = $request->date;
            $data->latitude = $request->lat;
            $data->longitude = $request->lng;
            $data->save();


        if($data->save()){
            //Redirect with Flash message

            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You requested for maintanance";
            $notification->save();

            return redirect('/maintanance')->with('status', 'Request For New Maintanance Submitted');
        }
        else{
            return redirect('/maintanance')->with('status', 'There was an error!');
        }

    }


    public function maintananceview()
    {
        $data = Maintanance::all();



        return view('admin.maintanance.maintanance',compact('data'));
    }


    public function Viewmap($id)
    {
        
        $data = Maintanance::find($id);

        return view('admin.maintanance.viewmap',compact('data'));
    }

    public function ViewConnectionMap($id)
    {
        
        $data = NewConnection::find($id);

        return view('admin.maintanance.viewconnectionmap',compact('data'));
    }


    public function mymeter()
    {
        $user = Auth::id();
        $carousel = Carousel::all();
        $mymeter = Meter::where('user_id', $user)->first();
        $count = Meter::where('user_id', $user)->count();
        

        return view('Frontend.mymeter',compact('mymeter','carousel','count'));
    }

    public function SearchMeter(Request $request)
    {
    
        
      $data = Meter::orwhere('name','LIKE',"%".$request->input("query")."%")->orwhere('meter_number',$request->input("query"))->get();
     
        return view('admin.meter.searchresults',compact('data'));
    }

    public function ViewTransaction(Request $request)
    {
    
        
      $data = Transaction::all();
     
        return view('admin.transaction.transactions',compact('data'));
    }

    public function SearchTransaction(Request $request)
    {
    
        
      $data = Transaction::orwhere('meter_name','LIKE',"%".$request->input("query")."%")->orwhere('transaction_id',$request->input("query"))->get();
    
        return view('admin.transaction.searchtransactions',compact('data'));
    }

    
    
    
    public function ExportTransaction()
    {
    
        $now = now()->format('D_M_Y');

        $excel = Excel::download(new TransactionExport, 'transaction_exported_at_'.$now.'.xlsx');
        return $excel;
    }
}
