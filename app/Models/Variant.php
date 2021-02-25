<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Variant
 *
 * @property int $id
 * @property int $product_id
 * @property int $price
 * @property int $rate
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Variant extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
