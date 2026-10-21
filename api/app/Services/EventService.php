<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Services\ServiceValidator;

/**
 * Service for Event model
 */
class EventService extends Service
{
    public function __construct(EventRepository $repository)
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

    // Set searchable fields for Event model
    protected function initialize()
    {
        $this->setSearchFields(['title', 'description']);
    }
}