<?php

namespace App\Common\V1\Http\Controllers;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Enumerable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function item(
        object|array|null $item,
        callable|string|object $transformer,
    ): Response|JsonResponse {
        if (!$item) {
            throw new HttpException(404, 'Неизвестный объект');
        }

        $transformer = new $transformer();

        return $this->response($transformer->transform($item));
    }

    /*
    Generate response with data transform for collection.
    */
    protected function collection(
        object $items,
        callable|string|object $transformer,
    ): Response|JsonResponse {
        $transformer = new $transformer();

        $response = ['data' => []];
        foreach ($items as $item) {
            $response['data'][] = $transformer->transform($item);
        }

        if ($paginator = $this->getPaginationResult($items)) {
            $response['pagination'] = $paginator;
        }

        return $this->response($response);
    }

    protected function getPaginationResult(object $paginator): array
    {
        $result = [];

        if ($paginator instanceof CursorPaginator) {
            $result = [
                'type' => 'cursor',
                'path' => $paginator->path(),
                'per_page' => $paginator->perPage(),
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'next_page_url' => $paginator->nextPageUrl(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'total' => $paginator->total() ?? null,
            ];
        } elseif ($paginator instanceof Paginator) {
            $result = [
                'type' => 'offset',
                'path' => $paginator->path(),
                'per_page' => $paginator->perPage(),
                'next_page_url' => $paginator->nextPageUrl(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'total' => $paginator->total() ?? null,
            ];
        }

        return $result;
    }

    /*
    Generate response.
    */
    protected function response(array|object $data = null): Response|JsonResponse
    {
        /**
         * @var ResponseFactory $responseFactory
         */
        $responseFactory = app(ResponseFactory::class);

        $successResult = $this->makeSuccessResult($data);
        $response = $responseFactory->json($successResult);

        return $response;
    }

    protected function makeSuccessResult(array|object $data = null): array
    {
        $result = [
            'success' => true,
            'message' => 'ok',
            'errors' => null,
            'data' => [],
        ];

        if (!$data) {
            return $result;
        }

        if ($data instanceof Enumerable) {
            $data = $data->toArray();
        }

        if (!isset($data['data'])) {
            $dataBuffer = $data;
            $data = [];
            $data['data'] = $dataBuffer;
        }

        $result = array_merge($result, $data);

        return $result;
    }
}
