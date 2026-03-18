<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'user_id', 'product_ids', 'reason', 'images', 'status', 'admin_reason'
    ];
    protected $casts = [
        'product_ids' => 'array',
        'images' => 'array',
    ];
    public function order() { return $this->belongsTo(Order::class); }
    public function user() { return $this->belongsTo(User::class); }
}
