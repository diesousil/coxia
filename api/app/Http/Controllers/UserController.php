<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for User model
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for User
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\UserResource::class;
    }

    /**
     * Create a new user
     */
    public function create(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->service->create($data);

        return $this->success($user)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a user by ID
     */
    public function getById(string $id): JsonResponse
    {
        $user = $this->service->getById($id);

        return $this->success($user);
    }

    /**
     * List users with pagination
     */
    public function list(UserRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $users = $this->service->list($pagination, true);

        return $this->success($users);
    }

    /**
     * Search users
     */
    public function search(UserRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $users = $this->service->search($searchTerms, $pagination, true);

        return $this->success($users);
    }

    /**
     * Update a user
     */
    public function update(UserRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $user = $this->service->edit($data, $id);

        return $this->success($user);
    }

    /**
     * Delete a user
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}