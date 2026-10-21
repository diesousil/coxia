<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation.Response;

/**
 * Controller for Order model
 */
class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource class for Order
     */
    protected function getResourceClass(): string
    {
        return \App\Http\Resources\OrderResource::class;
    }

    /**
     * Create a new order
     */
    public function create(OrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $order = $this->service->create($data);

        return $this->success($order)
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Get an order by ID
     */
    public function getById(string $id): JsonResponse
    {
        $order = $this->service->getById($id);

        return $this->success($order);
    }

    /**
     * List orders with pagination
     */
    public function list(OrderRequest $request): JsonResponse
    {
        $pagination = $request->only(['page', 'page_size']);
        $orders = $this->service->list($pagination, true);

        return $this->success($orders);
    }

    /**
     * Search orders
     */
    public function search(OrderRequest $request): JsonResponse
    {
        $searchTerms = $request->input('search');
        $pagination = $request->only(['page', 'page_size']);
        $orders = $this->service->search($searchTerms, $pagination, true);

        return $this->success($orders);
    }

    /**
     * Update an order
     */
    public function update(OrderRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $order = $this->service->edit($data, $id);

        return $this->success($order);
    }

    /**
     * Delete an order
     */
    public function delete(string $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return $this->success($result);
    }
}