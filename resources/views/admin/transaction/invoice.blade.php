@php
use Carbon\Carbon;
use App\Models\Meter;

$meter_number = Meter::findorfail($invoice->meter_id);
@endphp

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
<style>
    #invoice{
    padding: 30px;
}
a:link { text-decoration: none; }
a:visited { text-decoration: none; }
a:hover { text-decoration: none; }
a:active { text-decoration: none; }

.spoiler{ 
  color: rgba(0, 0, 0, 0.975); 
  background-color:rgb(0, 0, 0);
}
.spoiler:hover { 
  background-color:white; 
  }

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>

</head>


<!--Author      : @arboshiki-->

<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info" onclick="window.print();return false;"><i class="fa fa-print"></i> Print</button>
            {{-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> --}}
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="/">
                            <img style="width:200px; height:150px" src="{{ URL::asset('images/logo/dashboardlogo.jpg')}}" data-holder-rendered="true" title="Panidhara"/><br>   
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a style="color: " target="_blank" href="/">
                            PANIDHARA
                            </a>
                        </h2>
                        <div>Kapan, stupa</div>
                        <div>(123) 456-789</div>
                        <div>account@panidhara.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h6 class="to">{{$invoice->user_name}}</h6>
                        {{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
                        <div class="email"><a href="mailto:john@example.com">john@example.com</a></div> --}}
                    </div>
                    <div class="col invoice-details">
                        <h6 style="width:300px; margin-left:650px; color:black" class="invoice-id spoiler">INVOICE NO : {{$invoice->transaction_id}}</h6>
                        <div class="date">Date of Invoice: {{$invoice->created_at->format('D M Y')}}</div>
                        {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">PRODUCT</th>
                            <th class="text-right">PRICE</th>
                            <th style="width: 100px" class="text-right">FEE</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no">01</td>
                            <td style="width: 900px" class="text-left"><h3>
                                <a style="color: black" href="#">
                               {{$invoice->meter_name}}
                                </a>
                                </h3>
                               <p>
                             <span class="spoiler"> Meter No:  {{$meter_number->meter_number}}</span>
                               </p>

                            </td>
                            <td class="unit">Rs.{{$invoice->amount-0.3}}</td>
                            <td class="qty">Rs.{{$invoice->fee_amount/100}}</td>
                            <td class="total">Rs.{{$invoice->amount-0.3+$invoice->fee_amount/100}}</td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>Rs.{{$invoice->amount-0.3+$invoice->fee_amount/100}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 0%</td>
                            <td>Rs.0</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Payment Type</td>
                            <td style="background: rgb(96, 3, 183); color:white">{{$invoice->payment_type}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Payment Status</td>
                            <td style="background: green; color:rgb(255, 255, 255)">{{$invoice->transaction_state}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            @if($invoice['transaction_state'] == "Completed")
                            <td>PAID</td>
                            @else
                            <td>Rs.{{$invoice->amount-0.3+$invoice->fee_amount/100}}</td>
                            @endif
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">This is a meter purchased receipt. You will be charged monthly Rs.15 per unit</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
     {{-- <div></div> --}}
    </div>
</div>
