<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property string $transaction_no
 * @property string $method
 * @property string $status
 * @property float $amount
 * @property string|null $response_code
 * @property string|null $response_message
 * @property array|null $metadata
 * @property-read \App\Models\Order $order
 */
class PaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'payment_histories';

    protected $fillable = [
        'order_id',
        'transaction_no',
        'method',
        'status',
        'amount',
        'response_code',
        'response_message',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
