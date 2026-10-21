<?php

namespace App\Services;

use App\Models\Cache;
use App\Repositories\CacheRepository;
use App\Services\ServiceValidator;

/**
 * Service for Cache model
 */
class CacheService extends Service
{
    public function __construct(CacheRepository $repository)
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

    // Set searchable fields for Cache model
    protected function initialize()
    {
        $this->setSearchFields(['key']);
    }
}