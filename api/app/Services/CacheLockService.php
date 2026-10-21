<?php

namespace App\Services;

use App\Models\CacheLock;
use App\Repositories\CacheLockRepository;
use App\Services\ServiceValidator;

/**
 * Service for CacheLock model
 */
class CacheLockService extends Service
{
    public function __construct(CacheLockRepository $repository)
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

    // Set searchable fields for CacheLock model
    protected function initialize()
    {
        $this->setSearchFields(['key', 'owner']);
    }
}