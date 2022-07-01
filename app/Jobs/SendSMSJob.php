<?php

namespace App\Jobs;

use App\Api\SmsApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $details;
    /**
     * @var SmsApi
     */
    private $smsApi;

    public function __construct($details, SmsApi $smsApi)
    {
        $this->details = $details;
        $this->smsApi = $smsApi;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $origin_sms_message = 'New Balance after pay ' . $this->details['payment_value'] . ' will be ' . $this->details['origin_new_balance'];
        $destination_sms_message = 'New Balance after receiving ' . $this->details['payment_value'] . ' will be ' . $this->details['destination_new_balance'];


        $result = $this->smsApi->call(
            'POST',
            $this->smsApi->apiKey . '/sms/send.json',
            [
                'receptor' => $this->details['origin_mobile_number'],
                'sender' => '10004346',
                'message' => $origin_sms_message,
            ]
        );

        $result = $this->smsApi->call(
            'POST',
            $this->smsApi->apiKey . '/sms/send.json',
            [
                'receptor' => $this->details['destination_mobile_number'],
                'sender' => '10004346',
                'message' => $destination_sms_message,
            ]
        );

    }
}
