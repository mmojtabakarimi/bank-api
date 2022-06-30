<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Models\customerCards;
use App\Models\customers;


class CardController extends Controller
{
    //


    public function ListCards(): \Illuminate\Http\JsonResponse
    {
        return response()->json(customerCards::all());
    }

    public function ListCustomerCard($customerId)
    {
        return response()->json(customerCards::all()->where('customer_id', $customerId));
    }

    public function AddCard(CardRequest $request)
    {
        $validated = $request->validated();

        $customer_id = customers::where('mobile_number', $request->get('mobile_number'))->first()->id;

//        if($customer_id === null)
//        {
//            abort(400, 'Inbvalid Mobile Numebr');
//        }


        try {
            $id = customerCards::create([
                    'card_number' => $request->get('card_number'),
                    'balance' => $request->get('balance', '0'),
                    'customer_id' => $customer_id
                ]
            )->id;

            return response(['id' => $id], 201);

        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response($errorInfo, 200);
        }

    }
}
