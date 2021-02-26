<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;

class SingleProductProjector
{
    public static function convert(Product $product): array
    {
        $response = $product->toArray();

        foreach ($product->variant()->get() as $key => $variant) {
            $response['variants'][$key] = $variant;
            foreach (
                $variant->attribute()
                    ->get() as $attribute
            ) {
                $response['variants'][$key]['attribute'][] = $attribute;
            }
        }

        return $response;
    }
}
