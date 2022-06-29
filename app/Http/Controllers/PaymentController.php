<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoPaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function __construct()
    {

    }

    public function CheckHealth(Request $request)
    {
        return response(null, 200);
    }

    public function DoPayment(DoPaymentRequest $request)
    {
        $request->validated();

        return response(null, 200);
    }
}
