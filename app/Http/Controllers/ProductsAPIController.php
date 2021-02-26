<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsAPIController extends Controller
{
    public function get(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $response = $product->toArray();

        foreach ($product->variant()->get() as $key => $variant) {
            $response['variants'][$key] = $variant;
            foreach ($variant->attribute()->get() as $attribute) {
                $response['variants'][$key]['attribute'][] = $attribute;
            }
        }

        return response()->json(['product' => $response]);
    }

    /**
     * Walidacja pól została wyniesiona do klasy ProductsRequest
     */
    public function filter(ProductsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $results = DB::table('products');

        return response()->json($results->select()->get());
    }
}
