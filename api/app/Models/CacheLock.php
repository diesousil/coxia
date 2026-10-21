<?php

namespace App\Models;

/**
 * @property string $key
 * @property string $owner
 * @property int $expiration
 */
class CacheLock extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'cache_locks';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'key';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'key',
        'owner',
        'expiration',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'expiration' => 'integer',
    ];
}