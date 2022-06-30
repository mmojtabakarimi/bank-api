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

    public function __construct($details,SmsApi $smsApi)
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
        //
        $result = $this->smsApi->call(
            'POST',
            $this->smsApi->apiKey.'/sms/send.json',
            [
                'receptor'=>'09122356709',
                'sender'=>'10004346',
                'message'=>'this is test',
            ]
        );

    }
}
