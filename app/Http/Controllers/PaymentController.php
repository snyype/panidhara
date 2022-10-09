<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Meter;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $token = $request->token;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => 1000,
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.khalti_secret_key');

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data1 = json_decode($response,true);
        $amount = $data1['amount']*150/100;
        $idx = $data1['idx'];
        $productid = $data1['product_identity'];
        $token = $data1['token'];
        $transaction_state = $data1['state']['name'];
        var_dump($transaction_state);
        $fee_amount = $data1['fee_amount'];
        $payment_type = $data1['type']['name'];
        $user_name = $data1['user']['name'];
        $user_phone = $data1['user']['mobile'];
        $remarks = $data1['remarks'];
        $refunded = $data1['refunded'];
        $cashback = $data1['cashback'];
        $metername = Meter::find($productid);
        
       var_dump($transaction_state);

        $store = Transaction::insert(
            ['transaction_id' =>$idx, 'amount' =>$amount,'meter_id'=>$productid,'token'=>$token,'meter_name'=>$metername->name, 'created_at'=>\Carbon\Carbon::now(),'transaction_state'=>$transaction_state,'fee_amount'=>$fee_amount,'payment_type'=>$payment_type,'user_name'=>$user_name,'user_phone'=>$user_phone,'remarks'=>$remarks,'refunded'=>$refunded,'cashback'=>$cashback ]
        );
    
            
            $metername->user_name = auth()->user()->name;
            $metername->user_id = Auth::id();
            $metername->status = "Booked";
            $metername->save();


            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You Purchased $metername->name at price of Rs. $amount . PayType : Khalti";
            $notification->save();

            return $response;       
                
    }


    public function verifyPaymentForDue(Request $request)
    {
        $token = $request->token;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => 1000,
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.khalti_secret_key');

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data1 = json_decode($response,true);
        $amount = $data1['amount']*150/100;
        $idx = $data1['idx'];
        $productid = $data1['product_identity'];
        $token = $data1['token'];
        $transaction_state = $data1['state']['name'];
        var_dump($transaction_state);
        $fee_amount = $data1['fee_amount'];
        $payment_type = $data1['type']['name'];
        $user_name = $data1['user']['name'];
        $user_phone = $data1['user']['mobile'];
        $remarks = $data1['remarks'];
        $refunded = $data1['refunded'];
        $cashback = $data1['cashback'];
        $metername = Meter::find($productid);
        
       var_dump($transaction_state);

        $store = Transaction::insert(
            ['transaction_id' =>$idx, 'amount' =>$amount,'meter_id'=>$productid,'token'=>$token,'meter_name'=>$metername->name, 'created_at'=>\Carbon\Carbon::now(),'transaction_state'=>$transaction_state,'fee_amount'=>$fee_amount,'payment_type'=>$payment_type,'user_name'=>$user_name,'user_phone'=>$user_phone,'remarks'=>$remarks,'refunded'=>$refunded,'cashback'=>$cashback ]
        );
    
            
            $metername->unit = 0;
            $metername->due_amount = 0;
            $metername->save();


            $notification = new Notification();
            $notification->user_id = auth()->user()->id;
            $notification->message = "You Cleared this month's due amount of your meter $metername->meter_number  . PayType : $payment_type";
            $notification->save();

            return $response;       
                
    }





    public function ViewInvoice($id)
    {
        $invoice = Transaction::findorfail($id);

        return view('admin.transaction.invoice',compact('invoice'));
        

    }


 
   
}
