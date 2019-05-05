<?php

namespace App\Http\Controllers\client;

use App\Bill;
use App\Client;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientBillController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $bills = $client->bills;

        return $this->showAll($bills);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $collectionProductsResponse = new Collection();
        $rules = [
            'arrProducts' => 'required'
        ];

        $this->validate($request, $rules);


        $data = $request->all();

        foreach ($data['arrProducts'] as $product) {
            $product['client_id'] = $client->id;
            $response = Bill::create($product);

            $collectionProductsResponse->add($response);
        }

        return $this->showAll($collectionProductsResponse);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
