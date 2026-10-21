<?php

namespace App\Repositories;

use App\Models\Cache;

/**
 * Repository for Cache model
 */
class CacheRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Cache());
    }
}