<?php

namespace App\Http\Controllers;

use App\Events\PaymentNotificationSMSEvent;
use App\Http\Requests\DoPaymentRequest;
use App\Models\transactionLogs;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;


class PaymentController extends Controller
{


    /**
     * @var PaymentService
     */
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function CheckHealth(Request $request)
    {
        return response(null, 200);
    }

    public function DoPayment(DoPaymentRequest $request)
    {
        $request->validated();

        $payment_value = $request->get('payment_value');

        $sms_data = $this->paymentService->DoPayment($request->origin_card, $request->destination_card, (int)$payment_value);

        Event::dispatch(new PaymentNotificationSMSEvent($sms_data));

        return response($sms_data, 200);
    }

    public function listPaymentByCount($count)
    {
        return response()->json(transactionLogs::all()->take($count));
    }
}
