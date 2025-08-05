<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\RawMaterial
 *
 * @property int $id
 * @property string $name
 * @property int $unit_id
 * @property float $current_stock
 * @property float $minimum_stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereMinimumStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterial lowStock()
 * @method static \Database\Factories\RawMaterialFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class RawMaterial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'unit_id',
        'current_stock',
        'minimum_stock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'current_stock' => 'decimal:2',
        'minimum_stock' => 'decimal:2',
    ];

    /**
     * Get the unit for the raw material.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the transactions for the raw material.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(RawMaterialTransaction::class);
    }

    /**
     * Scope a query to only include low stock materials.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'minimum_stock');
    }
}