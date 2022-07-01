<?php

namespace App\Services;

use App\Models\customers;
use App\Models\customerCards;
use App\Models\transactionCosts;
use App\Models\transactionLogs;

class PaymentService
{

    public function __construct()
    {

    }

    public function GetCardBalance($card): int
    {
        $cardInfo = customerCards::all()->where('card_number', $card)->first();

        if ($cardInfo === null) {
            abort(400, 'Invalid origin Card Number');
        }

        return (int)$cardInfo->balance;
    }

    public function GetMobileNumberByCard($card)
    {
        $cardInfo = customerCards::all()->where('card_number', $card)->first();

        if ($cardInfo === null) {
            abort(400, 'Invalid origin Card Number');
        }

        $customerInfo = customers::all()->where('id', $cardInfo->customer_id)->first();

        return $customerInfo->mobile_number;
    }

    public function DoPayment($origin_card, $destination_card, $payment_value)
    {

        $origin_balance = $this->GetCardBalance($origin_card);

        $destination_balance = (int)$this->GetCardBalance($destination_card);

        if (($origin_balance - $payment_value - 500) > 0) {
            $origin_new_balance = $origin_balance - $payment_value - 500;
            $destination_new_balance = $destination_balance + $payment_value;

            $this->UpdateCardBalance($origin_card, $destination_card, $origin_new_balance, $destination_new_balance);
            $data = [
                'origin_new_balance' => $origin_new_balance,
                'destination_new_balance' => $destination_new_balance,


            ];
            $reference_id = $this->SavePaymentLog($origin_card, $destination_card, $payment_value);

            return [
                'origin_card' => $origin_card,
                'destination_card' => $destination_card,
                'origin_new_balance' => $origin_new_balance,
                'destination_new_balance' => $destination_new_balance,
                'payment_value' => $payment_value,
                'origin_mobile_number' => $this->GetMobileNumberByCard($origin_card),
                'destination_mobile_number' => $this->GetMobileNumberByCard($destination_card),
                'reference_id' => $reference_id,
            ];
        }
        abort(400, 'insufficient origin Card balance');

    }

    public function UpdateCardBalance($origin_card, $destination_card, $origin_new_balance, $destination_new_balance)
    {
        $cardInfo = customerCards::all()->where('card_number', $origin_card)->first();
        $cardInfo->balance = $origin_new_balance;
        $cardInfo->save();

        $cardInfo = customerCards::all()->where('card_number', $destination_card)->first();
        $cardInfo->balance = $destination_new_balance;
        $cardInfo->save();

    }

    public function SavePaymentLog($origin_card, $destination_card, $payment_value)
    {
        $reference_id = uniqid(mt_rand(), true);

        transactionLogs::create(
            [
                'original_card_number' => $origin_card,
                'destination_card_number' => $destination_card,
                'payment_value' => $payment_value,
                'reference_id' => $reference_id,
            ]
        );

        $this->SavePaymentCost($origin_card, $reference_id, '500');

        return $reference_id;
    }

    public function SavePaymentCost($origin_card, $reference_id, $transaction_cost)
    {
        transactionCosts::create([
                'transaction_cost' => $transaction_cost,
                'transaction_id' => $reference_id,
                'card_id' => $origin_card,
            ]
        );
    }

}
