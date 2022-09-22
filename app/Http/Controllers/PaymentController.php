<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $token = $request->token;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => 150000,
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
        $amount = $data1['amount'];
        $idx = $data1['idx'];
        $productid = $data1['product_identity'];
        $token = $data1['token'];
        $metername = "Khaanepani Sewa";
       

        $store = Transaction::insert(
            ['transaction_id' =>$idx, 'amount' =>$amount,'meter_id'=>$productid,'token'=>$token,'meter_name'=>$metername]
        );
        
    return $response;

//        
                
    }

    public function storePayment(Request $request)
    {

        $response = $request->response;

        $snype = json_decode($response, true);

        var_dump($snype);

        foreach ($snype as $name => $data) {
            var_dump($name, $data['idx'], $data['amount']); // $name is the Name of Room
        }
    }


    public function thankyou()
    {
        return view("thankyou");
    }
}
