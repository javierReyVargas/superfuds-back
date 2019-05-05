<?php

namespace App\Http\Controllers\provider;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;

class ProviderProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Provider $provider)
    {
        $products = $provider->products;

        return $this->showAll($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provider $provider)
    {
        $rules = [
            'name' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required',
            'numLot' => 'required',
            'expirationDate' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['provider_id'] = $provider->id;

        $product = Product::create($data);

        return $this->showOne($provider, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
