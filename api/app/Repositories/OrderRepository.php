<?php

namespace App\Repositories;

use App\Models\Order;

/**
 * Repository for Order model
 */
class OrderRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Order());
    }
}