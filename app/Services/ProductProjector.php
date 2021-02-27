<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

final class ProductProjector extends Projector
{
    private string $orderBy;
    private string $order;

    public function __construct(string $orderBy = 'price', string $order = 'ASC')
    {
        $this->orderBy = $orderBy;
        $this->order = $order;
    }

    public function convert(Collection $collection): array
    {
        $response = [];
        foreach ($collection as $product) {
            if (!isset($response[$product->id])) {
                $response[$product->id] = [
                    self::ID          => $product->id,
                    self::TYPE        => $product->type,
                    self::DESCRIPTION => $product->description,
                    self::IMAGE_URL   => $product->image_url
                ];
            }
            if (!isset($response[$product->id][self::VARIANTS][$product->v_id])) {
                $response[$product->id][self::VARIANTS][$product->v_id] = [
                    self::ID        => $product->v_id,
                    self::PRICE     => $product->price,
                    self::RATE      => $product->rate,
                    self::IMAGE_URL => $product->v_image_url,
                ];
            }
            $response[$product->id][self::VARIANTS][$product->v_id][self::ATTRIBUTES][$product->a_id] = [
                self::ID      => $product->a_id,
                self::A_NAME  => $product->a_name,
                self::A_VALUE => $product->a_value
            ];
        }

        foreach ($response as $key => $row) {
            $column = array_column($row[self::VARIANTS], $this->orderBy);
            array_multisort($column, 'DESC' === $this->order ? SORT_DESC : SORT_ASC , $row[self::VARIANTS]);

            $response[$key][self::VARIANTS] = $row[self::VARIANTS];
        }

        return $response;
    }
}
