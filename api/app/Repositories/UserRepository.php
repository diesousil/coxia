<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Repository for User model
 */
class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new User());
    }
}