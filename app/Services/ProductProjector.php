<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

class ProductProjector
{
    public static function convert(Collection $collection): array
    {
        $response = [];
        foreach ($collection as $key => $product) {
            $response[$key] = [
                'id'          => $product->id,
                'type'        => $product->type,
                'description' => $product->description,
                'image_url'   => $product->image_url,
                'variant'     => [
                    'id'        => $product->v_id,
                    'price'     => $product->price,
                    'rate'      => $product->rate,
                    'image_url' => $product->v_image_url,
                    'attribute' => [
                        'id'      => $product->a_id,
                        'a_name'  => $product->a_name,
                        'a_value' => $product->a_value
                    ]
                ]
            ];
        }

        return $response;
    }
}
