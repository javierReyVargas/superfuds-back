<?php

namespace App\Http\Controllers\provider;

use App\Client;
use App\Http\Controllers\ApiController;
use App\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderReportController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Provider $provider)
    {
        $collectionResponse = new Collection();

        $products = $provider->products()->has('bills')->get();

        $arrResponse = Array();
        $total = 0;
        foreach ($products as $product) {
            foreach ($product->bills as $bill) {
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
