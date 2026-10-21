<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\ServiceValidator;

/**
 * Service for Order model
 */
class OrderService extends Service
{
    public function __construct(OrderRepository $repository)
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

    // Set searchable fields for Order model
    protected function initialize()
    {
        $this->setSearchFields(['status']);
    }
}