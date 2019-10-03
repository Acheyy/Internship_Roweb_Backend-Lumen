<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorCodes;
use App\Models\Product;
use Illuminate\Http\Request;



class SalesController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $pagParams = $this->getPaginationParams($request);

            $products = Product::whereColumn('full_price', '>', 'sale_price');

            $paginationData = $this->getPaginationData($products, $pagParams['page'], $pagParams['limit']);

            $products = $products->offset($pagParams['offset'])->limit($pagParams['limit'])->get();

            return $this->returnSuccess($products, $paginationData);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), ErrorCodes::FRAMEWORK_ERROR);
        }
    }
}
