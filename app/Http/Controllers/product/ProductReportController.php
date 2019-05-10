<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductReportController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $collectionResponse = new Collection();

        $arrBills = $product->bills;
        $product->provider;

        $total = 0;
        $arrResponse = Array();
        foreach ($arrBills as $bill) {
            $bill->client;
            $total += $product->price * $bill->pivot->quantity;

            array_push($arrResponse, [
                'product' => $product->name,
                'price' => $product->price,
                'quantityBuy' => $bill->pivot->quantity,
                'provider' => $product->provider,
                'client' => $bill->client,
                'created_at' => $bill->created_at,
            ]);
        }

        $collectionResponse->add(
            [
                'products' => $arrResponse,
                'total' => $total,
            ]
        );

        return $this->showAll($collectionResponse);
    }

}
