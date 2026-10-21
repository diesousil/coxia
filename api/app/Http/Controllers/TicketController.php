<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for Ticket model
 */
class TicketController extends Controller
{
    /**
     * @var TicketService
     */
    protected $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for Ticket
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\TicketResource::class;
    }

    /**
     * Create a new ticket
     */
    public function create(TicketRequest $request): JsonResponse
    {
        $data = $request->validated();
        $ticket = $this->service->create($data);

        return $this->success($ticket)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get a ticket by ID
     */
    public function getById(string $id): JsonResponse
    {
        $ticket = $this->service->getById($id);

        return $this->success($ticket);
    }

    /**
     * List tickets with pagination
     */
    public function list(TicketRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $tickets = $this->service->list($pagination, true);

        return $this->success($tickets);
    }

    /**
     * Search tickets
     */
    public function search(TicketRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $tickets = $this->service->search($searchTerms, $pagination, true);

        return $this->success($tickets);
    }

    /**
     * Update a ticket
     */
    public function update(TicketRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $ticket = $this->service->edit($data, $id);

        return $this->success($ticket);
    }

    /**
     * Delete a ticket
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}