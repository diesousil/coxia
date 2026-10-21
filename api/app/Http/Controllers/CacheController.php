<?php

namespace App\Http\Controllers;

use App\Http\Requests\CacheRequest;
use App\Models\Cache;
use App\Services\CacheService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for Cache model
 */
class CacheController extends Controller
{
    /**
     * @var CacheService
     */
    protected $service;

    public function __construct(CacheService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for Cache
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\CacheResource::class;
    }

    /**
     * Create a new cache entry
     */
    public function create(CacheRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cache = $this->service->create($data);

        return $this->success($cache)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a cache entry by key
     */
    public function getById(string $id): JsonResponse
    {
        $cache = $this->service->getById($id);

        return $this->success($cache);
    }

    /**
     * List cache entries with pagination
     */
    public function list(CacheRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $caches = $this->service->list($pagination, true);

        return $this->success($caches);
    }

    /**
     * Search cache entries
     */
    public function search(CacheRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $caches = $this->service->search($searchTerms, $pagination, true);

        return $this->success($caches);
    }

    /**
     * Update a cache entry
     */
    public function update(CacheRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $cache = $this->service->edit($data, $id);

        return $this->success($cache);
    }

    /**
     * Delete a cache entry
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}