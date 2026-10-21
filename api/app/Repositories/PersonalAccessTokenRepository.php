<?php

namespace App\Repositories;

use App\Models\PersonalAccessToken;

/**
 * Repository for PersonalAccessToken model
 */
class PersonalAccessTokenRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new PersonalAccessToken());
    }
}