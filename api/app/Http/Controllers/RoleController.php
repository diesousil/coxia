<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for Role model
 */
class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    protected $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for Role
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\RoleResource::class;
    }

    /**
     * Create a new role
     */
    public function create(RoleRequest $request): JsonResponse
    {
        $data = $request->validated();
        $role = $this->service->create($data);

        return $this->success($role)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a role by ID
     */
    public function getById(string $id): JsonResponse
    {
        $role = $this->service->getById($id);

        return $this->success($role);
    }

    /**
     * List roles with pagination
     */
    public function list(RoleRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $roles = $this->service->list($pagination, true);

        return $this->success($roles);
    }

    /**
     * Search roles
     */
    public function search(RoleRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $roles = $this->service->search($searchTerms, $pagination, true);

        return $this->success($roles);
    }

    /**
     * Update a role
     */
    public function update(RoleRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $role = $this->service->edit($data, $id);

        return $this->success($role);
    }

    /**
     * Delete a role
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}