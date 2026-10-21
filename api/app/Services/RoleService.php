<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Services\ServiceValidator;

/**
 * Service for Role model
 */
class RoleService extends Service
{
    public function __construct(RoleRepository $repository)
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

    // Set searchable fields for Role model
    protected function initialize()
    {
        $this->setSearchFields(['name', 'slug']);
    }
}