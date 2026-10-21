<?php

namespace App\Services;

use App\Models\PersonalAccessToken;
use App\Repositories\PersonalAccessTokenRepository;
use App\Services\ServiceValidator;

/**
 * Service for PersonalAccessToken model
 */
class PersonalAccessTokenService extends Service
{
    public function __construct(PersonalAccessTokenRepository $repository)
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

    // Set searchable fields for PersonalAccessToken model
    protected function initialize()
    {
        $this->setSearchFields(['name', 'token']);
    }
}