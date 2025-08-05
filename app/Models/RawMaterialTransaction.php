<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RawMaterialTransaction
 *
 * @property int $id
 * @property int $raw_material_id
 * @property int|null $supplier_id
 * @property string $type
 * @property float $quantity
 * @property float|null $unit_price
 * @property float|null $total_amount
 * @property string|null $notes
 * @property string $transaction_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereRawMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RawMaterialTransaction whereUpdatedAt($value)
 * @method static \Database\Factories\RawMaterialTransactionFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class RawMaterialTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'raw_material_id',
        'supplier_id',
        'type',
        'quantity',
        'unit_price',
        'total_amount',
        'notes',
        'transaction_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    /**
     * Get the raw material for the transaction.
     */
    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class);
    }

    /**
     * Get the supplier for the transaction.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}