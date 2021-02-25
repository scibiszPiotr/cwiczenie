<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property int $variant_id
 * @property string $a_name
 * @property string $a_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereAValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereVariantId($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    use HasFactory;

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
