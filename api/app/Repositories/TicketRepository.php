<?php

namespace App\Repositories;

use App\Models\Ticket;

/**
 * Repository for Ticket model
 */
class TicketRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Ticket());
    }
}