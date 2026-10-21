<?php

namespace App\Repositories;

use App\Models\CacheLock;

/**
 * Repository for CacheLock model
 */
class CacheLockRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new CacheLock());
    }
}