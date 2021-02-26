<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private const PRODUCTS    = 'products';
    private const DESCRIPTION = 'description';
    private const ORDER_BY    = 'orderBy';
    private const ORDER       = 'order';
    private const A_NAME      = 'a_name';
    private const A_VALUE     = 'a_value';
    private const ATTRIBUTES  = 'attributes';
    private const VARIANTS    = 'variants';

    public function getByParameters(array $data): array
    {
        $sql = DB::table(self::PRODUCTS)->join(self::VARIANTS, 'products.id', '=', 'variants.product_id');

        if (isset($data[self::DESCRIPTION])) {
            $sql->where(self::DESCRIPTION, 'LIKE', "%{$data[self::DESCRIPTION]}%");
        }

        if (isset($data[self::ORDER_BY])) {
            $sql->orderBy($data[self::ORDER_BY], $data[self::ORDER] ?? 'DESC');
        }

        if (isset($data[self::A_NAME]) || isset($data[self::A_VALUE])) {
            $sql->leftJoin(self::ATTRIBUTES, 'variants.id', '=', 'attributes.variant_id');

            if (isset($data[self::A_NAME])) {
                $sql->where(self::A_NAME, '=', $data[self::A_NAME]);
            }

            if (isset($data[self::A_VALUE])) {
                $sql->where(self::A_VALUE, '=', $data[self::A_VALUE]);
            }
        }

        return ProductProjector::convert($sql->select()->get());
    }

    public function get(int $id): array
    {
        $product = Product::findOrFail($id);
        $response = $product->toArray();

        foreach (
            $product->variant()
                ->get() as $key => $variant
        ) {
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
