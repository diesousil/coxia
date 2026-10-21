<?php

namespace App\Repositories;

use App\Models\Event;

/**
 * Repository for Event model
 */
class EventRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Event());
    }
}