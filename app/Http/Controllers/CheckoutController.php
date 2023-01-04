<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notifications\InvoicePaid;
use App\PaymentGatewaySetting;
use App\Receipt;
use App\Settings;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoice = Invoice::find($request->inv);

  
        $parent = Auth::user();

        $pNofitications = User::find($parent->id)->unreadNotifications;

        

        $numOfNotifications = count($pNofitications);

        

        return view('checkout.index')->with([
            'invoice'=> $invoice,
            'pNofitications' => $pNofitications,
            'numOfNotifications' => $numOfNotifications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inv = $request->items;

        $invoice = Invoice::find($inv);

        $amtReceipt = 0;

        foreach ($invoice->receipt as $receipt) {
                $amtReceipt += $receipt->amount;
        }
        $invAmt = $invoice->amount;

        $balance = $invAmt - $amtReceipt;

        $paySettings = PaymentGatewaySetting::find(1);

        if (! $paySettings) {
            $key = 'sk_test_51HY26JJsL6OGbcr6yeTGu2BgSu3gNBjBQKE1xH65u9cLiFTiTp4CZ6ouVF5PuLIujruIeAECG3AeOROaqUydnRjv00sM6S6v1W';
        } else {
            $key = $paySettings->private_key; 
        }

       
        
        Stripe::setApiKey($key);



        function calculateOrderAmount($balance): int {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            
            return $balance;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = PaymentIntent::create([
                'customer' => $request->user,
                'amount' => calculateOrderAmount($balance),
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $paymentIntent->amount
            ];

            

            return json_encode($output);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
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
        //
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
        dd($request);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myupdate($id)
    {
        $invoice = Invoice::find($id);

        $invoice->status = 'paid';
        $invoice->update();

        $receipt = new Receipt();
        $receipt->parent_id = $invoice->parent_id;
        $receipt->invoice_id = $invoice->id;
        $receipt->amount = $invoice->amount;
        $receipt->receipt_num = rand();
        $receipt->save();

        $users = User::where('user_type', 'LIKE', 'office staff')->get();

        Notification::send($users, new InvoicePaid($invoice));
        
        return redirect()->route('phome')->with('success', 'payment was successful');
    }


    public function getKey()
    {
        $settings = PaymentGatewaySetting::find(1);
        

        if (! $settings) {
            $publicKey = 'pk_test_51HY26JJsL6OGbcr6YqUofolvSJLapbmQ2x13RDvUx4wIEtEB8gjKwyUaJTB2qmEI3dXJCXjRJsiv2WfVTYWl1u6K00OqaVC8Qm';
        } else {
            $publicKey = $settings->public_key;
        }
        

        return Response($publicKey);
    }
}
