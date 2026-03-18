<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property float $total_price
 * @property string $status
 * @property string $payment_status
 * @property string|null $transaction_no
 * @property string|null $transaction_date
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\OrderItem> $items
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_status',
        'transaction_no',
        'transaction_date',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentHistories(): HasMany
    {
        return $this->hasMany(PaymentHistory::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // Helper methods
    public function isPaid(): bool
    {
        return $this->payment_status === 'completed' || $this->status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending' && $this->payment_status === 'pending';
    }

    public function isPaymentFailed(): bool
    {
        return $this->payment_status === 'failed';
    }
}

