<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

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
}
