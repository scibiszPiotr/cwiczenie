<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
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
        $sql = DB::table(self::PRODUCTS)->leftJoin(self::VARIANTS, 'products.id', '=', 'variants.product_id');

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

        return ProductProjector::convert(
            $sql->select(
                [
                    'products.*',
                    'variants.id as v_id',
                    'variants.price',
                    'variants.rate',
                    'variants.image_url as v_image_url',
                    'attributes.id as a_id',
                    'attributes.a_name',
                    'attributes.a_value']
            )
                ->get()
        );
    }

    public function get(int $id): array
    {
        return SingleProductProjector::convert(Product::findOrFail($id));
    }
}
