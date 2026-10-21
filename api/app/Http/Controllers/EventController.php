<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for Event model
 */
class EventController extends Controller
{
    /**
     * @var EventService
     */
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for Event
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\EventResource::class;
    }

    /**
     * Create a new event
     */
    public function create(EventRequest $request): JsonResponse
    {
        $data = $request->validated();
        $event = $this->service->create($data);

        return $this->success($event)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get an event by ID
     */
    public function getById(string $id): JsonResponse
    {
        $event = $this->service->getById($id);

        return $this->success($event);
    }

    /**
     * List events with pagination
     */
    public function list(EventRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $events = $this->service->list($pagination, true);

        return $this->success($events);
    }

    /**
     * Search events
     */
    public function search(EventRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $events = $this->service->search($searchTerms, $pagination, true);

        return $this->success($events);
    }

    /**
     * Update an event
     */
    public function update(EventRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $event = $this->service->edit($data, $id);

        return $this->success($event);
    }

    /**
     * Delete an event
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}