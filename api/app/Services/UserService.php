<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ServiceValidator;

/**
 * Service for User model
 */
class UserService extends Service
{
    public function __construct(UserRepository $repository)
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

    // Set searchable fields for User model
    protected function initialize()
    {
        $this->setSearchFields(['name', 'email']);
    }
}