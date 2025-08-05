<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\FinishedProduct
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $color
 * @property string $size
 * @property float $selling_price
 * @property float $current_stock
 * @property float $minimum_stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereMinimumStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishedProduct lowStock()
 * @method static \Database\Factories\FinishedProductFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class FinishedProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'color',
        'size',
        'selling_price',
        'current_stock',
        'minimum_stock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'selling_price' => 'decimal:2',
        'current_stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
    ];

    /**
     * Get the category for the finished product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the sale items for the finished product.
     */
    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Scope a query to only include low stock products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'minimum_stock');
    }
}