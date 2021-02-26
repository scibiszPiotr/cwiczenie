<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

class ProductProjector
{
    public static function convert(Collection $collection): array
    {
        return $collection->toArray();
        foreach ($collection as $product) {
            dd($product);
        }
    }
}
