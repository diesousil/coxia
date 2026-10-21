<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use App\Services\ServiceValidator;

/**
 * Service for Ticket model
 */
class TicketService extends Service
{
    public function __construct(TicketRepository $repository)
    {
        parent::__construct($repository);
        $this->initialize();
    }

    protected function setValidator()
    {
        $validatorClassName = get_class($this) . 'Validator';

        if (class_exists($validatorClassName)) {
            $this->validator = app()->makeWith(
                $validatorClassName,
                ['repository' => $this->repository],
            );
        }
    }

    // Set searchable fields for Ticket model
    protected function initialize()
    {
        $this->setSearchFields(['qrcode_check']);
    }
}