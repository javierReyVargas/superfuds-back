<?php

namespace App\Http\Controllers\client;

use App\Bill;
use App\Client;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            foreach ($data['arrProducts'] as $product) {

                if ( $product['quantityBuy'] <= $product['quantity'] ) {

                    $modelProduct = Product::findOrFail($product['id']);
                    $modelProduct->quantity = $modelProduct->quantity - $product['quantityBuy'];

                    if ($modelProduct->save()){
                        $product['client_id'] = $client->id;
                        $product['product_id'] = $product['id'];
                        $product['quantity'] = $product['quantityBuy'];

                        $response = Bill::create($product);

                        $collectionProductsResponse->add($response);
                    } else {
                        DB::rollback();
                        return $this->errorResponse('Ha ocurrido un error al modificar el inventario para:  '. $product['name'] .' es de ' . $product['quantity'], 429);
                    }
                } else {
                    DB::rollback();
                    return $this->errorResponse('La disponibilidad del producto '. $product['name'] .' es de ' . $product['quantity'], 429);
                }
            }

            DB::commit();
            return $this->showAll($collectionProductsResponse);
        } catch (\Exception $e) {

            DB::rollback();
            return $this->errorResponse($e.message, $e.code);
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
