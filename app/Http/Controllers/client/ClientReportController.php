<?php

namespace App\Http\Controllers\client;

use App\Client;
use App\Http\Controllers\ApiController;
use Illuminate\Database\Eloquent\Collection;

class ClientReportController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $dataResponseCollection = new Collection();
        $dataResponse = $client->bills;
        $arrProducts = Array();
        $total = 0;

        foreach ($dataResponse as $bill) {
            foreach ($bill->products as $product) {
                $product->provider;
                $total += $product->price * $product->pivot->quantity;
                array_push($arrProducts, [
                    'product' => $product->name,
                    'price' => $product->price,
                    'quantityBuy' => $product->pivot->quantity,
                    'provider' => $product->provider,
                    'client' => $bill->client,
                    'created_at' => $bill->created_at,
                    'total' => $bill->created_at,
                ]);
            }
        }

        $dataResponseCollection->add(
            [
                'products' => $arrProducts,
                'total' => $total,
            ]
        );
        return $this->showAll($dataResponseCollection);
    }
}
