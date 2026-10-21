<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalAccessTokenRequest;
use App\Models\PersonalAccessToken;
use App\Services\PersonalAccessTokenService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for PersonalAccessToken model
 */
class PersonalAccessTokenController extends Controller
{
    /**
     * @var PersonalAccessTokenService
     */
    protected $service;

    public function __construct(PersonalAccessTokenService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for PersonalAccessToken
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\PersonalAccessTokenResource::class;
    }

    /**
     * Create a new personal access token
     */
    public function create(PersonalAccessTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        $token = $this->service->create($data);

        return $this->success($token)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a personal access token by ID
     */
    public function getById(string $id): JsonResponse
    {
        $token = $this->service->getById($id);

        return $this->success($token);
    }

    /**
     * List personal access tokens with pagination
     */
    public function list(PersonalAccessTokenRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $tokens = $this->service->list($pagination, true);

        return $this->success($tokens);
    }

    /**
     * Search personal access tokens
     */
    public function search(PersonalAccessTokenRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $tokens = $this->service->search($searchTerms, $pagination, true);

        return $this->success($tokens);
    }

    /**
     * Update a personal access token
     */
    public function update(PersonalAccessTokenRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $token = $this->service->edit($data, $id);

        return $this->success($token);
    }

    /**
     * Delete a personal access token
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}