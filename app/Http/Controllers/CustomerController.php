<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function AddCustomer(CustomerRequest $request)
    {
        $request->validated();
        try {
            $id = customers::create([
                    'mobile_number' => $request->get('mobile_number'),
                    'name' => $request->get('name')
                ]
            )->id;

            return response(['id' => $id], 201);

        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response($errorInfo, 200);
        }

    }

    public function ListCustomers(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(customers::all());
    }
}
