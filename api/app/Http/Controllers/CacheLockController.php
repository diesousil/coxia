<?php

namespace App\Http\Controllers;

use App\Http\Requests\CacheLockRequest;
use App\Models\CacheLock;
use App\Services\CacheLockService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for CacheLock model
 */
class CacheLockController extends Controller
{
    /**
     * @var CacheLockService
     */
    protected $service;

    public function __construct(CacheLockService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for CacheLock
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\CacheLockResource::class;
    }

    /**
     * Create a new cache lock
     */
    public function create(CacheLockRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cacheLock = $this->service->create($data);

        return $this->success($cacheLock)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a cache lock by key
     */
    public function getById(string $id): JsonResponse
    {
        $cacheLock = $this->service->getById($id);

        return $this->success($cacheLock);
    }

    /**
     * List cache locks with pagination
     */
    public function list(CacheLockRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $cacheLocks = $this->service->list($pagination, true);

        return $this->success($cacheLocks);
    }

    /**
     * Search cache locks
     */
    public function search(CacheLockRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $cacheLocks = $this->service->search($searchTerms, $pagination, true);

        return $this->success($cacheLocks);
    }

    /**
     * Update a cache lock
     */
    public function update(CacheLockRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $cacheLock = $this->service->edit($data, $id);

        return $this->success($cacheLock);
    }

    /**
     * Delete a cache lock
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}