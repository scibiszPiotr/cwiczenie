<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

final class SingleProductProjector extends Projector
{
    private const AMOUNT = 'amount';

    public function convert(Collection $collection): array
    {
        $response[$collection[0]->id] = [
            self::ID          => $collection[0]->id,
            self::TYPE        => $collection[0]->type,
            self::DESCRIPTION => $collection[0]->description,
            self::IMAGE_URL   => $collection[0]->image_url,
            self::AMOUNT      => $collection[0]->amount
        ];
        foreach ($collection as $product) {
            if (!isset($response[$product->id][self::VARIANTS][$product->v_id])) {
                $response[$product->id][self::VARIANTS][$product->v_id] = [
                    self::ID        => $product->v_id,
                    self::PRICE     => $product->price,
                    self::RATE      => $product->rate,
                    self::IMAGE_URL => $product->v_image_url
                ];
            }
            $response[$product->id][self::VARIANTS][$product->v_id][self::ATTRIBUTES][$product->a_id] = [
                self::ID      => $product->a_id,
                self::A_NAME  => $product->a_name,
                self::A_VALUE => $product->a_value
            ];
        }

        return $response[$collection[0]->id];
    }
}
