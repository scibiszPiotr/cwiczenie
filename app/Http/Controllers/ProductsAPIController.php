<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductsAPIController extends Controller
{
    public function get(ProductService $productService, int $id): JsonResponse
    {
        return response()->json($productService->get($id));
    }

    /**
     * Walidacja pól została wyniesiona do klasy ProductsRequest
     *
     * @param ProductsRequest $request
     * @param ProductService  $productService
     *
     * @return JsonResponse
     */
    public function filter(ProductsRequest $request, ProductService $productService): JsonResponse
    {
        $data = $request->validated();

        return response()->json($productService->getByParameters($data));
    }
}
