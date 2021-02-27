<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

abstract class Projector
{
    protected const VARIANTS    = 'variants';
    protected const ATTRIBUTES  = 'attributes';
    protected const ID          = 'id';
    protected const TYPE        = 'type';
    protected const DESCRIPTION = 'description';
    protected const IMAGE_URL   = 'image_url';
    protected const PRICE       = 'price';
    protected const RATE        = 'rate';
    protected const A_NAME      = 'a_name';
    protected const A_VALUE     = 'a_value';

    public abstract function convert(Collection $collection): array;
}
