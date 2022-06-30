<?php

namespace App\Listeners;

use App\Api\SmsApi;
use App\Events\PaymentNotificationSMSEvent;
use App\Jobs\SendSMSJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentNotificationSMSListener
{
    /**
     * @var SmsApi
     */
    private $smsApi;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SmsApi $smsApi)
    {
        $this->smsApi = $smsApi;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentNotificationSMSEvent $event)
    {
        dispatch(new SendSMSJob($event->sms_data, $this->smsApi));
    }
}
