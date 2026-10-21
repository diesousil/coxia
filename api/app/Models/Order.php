<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string|null $user_id
 * @property string|null $event_id
 * @property PaymentStatusEnum::cases() $status
 * @property int|null $quantity
 * @property float|null $total_value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'quantity',
        'total_value',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'quantity' => 'integer',
        'total_value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the event associated with the order.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get the tickets associated with the order.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'order_id');
    }
}