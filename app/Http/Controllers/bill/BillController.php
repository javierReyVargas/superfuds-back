<?php

namespace App\Http\Controllers\bill;

use App\Bill;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionDataProduct = new Collection();

        $dataResponse = Bill::all();

        foreach ($dataResponse as $item) {
            $item->client;
            $item->products;

            foreach ($item->products as $product) {
                foreach ($item->products()->withPivot('quantity')
                             ->get() as $bill) {
                    if ( $product->id == $bill->id) {
                        $product['quantityBuy'] = $bill->pivot->quantity;
                    } else {
                        continue;
                    }
                }
                $collectionDataProduct->add($product);
            }
        }

        return $this->showAll($dataResponse);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        DB::beginTransaction();
        try{

            $billProducts = $bill->products()
                ->withPivot('quantity')
                ->get()
                ->pluck('pivot');

            foreach ( $billProducts as $billProduct ) {
                $product = Product::findOrFail($billProduct['product_id']);
                $product->quantity += $billProduct['quantity'];
                $product->save();
            }

            if ( $bill->products()->detach() ) {

                if ( $bill->delete() ) {
                    DB::commit();
                    return $this->showOne($bill);
                } else {
                    DB::rollback();
                    return $this->errorResponse('Ha ocurrido un error al eliminar la factura', 500);
                }

            } else {

                DB::rollback();
                return $this->errorResponse('Ha ocurrido un error al eliminar los productos de la factura', 500);
            }
        }catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e, 500);
        }
    }
}
