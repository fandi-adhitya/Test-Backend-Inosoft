<?php

namespace App\Contracts;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use JsonSerializable;

abstract class Response
{
    /**
     * Possible response message
     */
    public const MESSAGE_OK = 'OK_SUCCESS';

    public const MESSAGE_CREATED = 'CREATED';

    public const MESSAGE_UNAUTHENTICATED = 'UNAUTHENTICATED';

    public const MESSAGE_NOT_FOUND = 'NOT_FOUND';

    public const MESSAGE_NOT_ACCEPTABLE = 'NOT_ACCEPTABLE';

    public const MESSAGE_UNPROCESSABLE_ENTITY = 'UNPROCESSABLE_ENTITY';

    public const MESSAGE_NO_CONTENT = 'NO_CONTENT';

    public const MESSAGE_SERVER_ERROR = 'SERVER_ERROR';

    /**
     * Possible response status codes
     */
    public const STATUS_OK = 200;

    public const STATUS_CREATED = 201;

    public const STATUS_UNAUTHENTICATED = 401;

    public const STATUS_NOT_FOUND = 404;

    public const STATUS_NOT_ACCEPTABLE = 406;

    public const STATUS_SERVER_ERROR = 500;

    public const STATUS_UNPROCESSABLE_ENTITY = 422;

    public const STATUS_NO_CONTENT = 204;

    /**
     * @param  \Illuminate\Contracts\Support\Arrayable|\JsonSerializable|array|null  $data
     * @param  string  $message
     * @param  int  $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json(
        $data = null,
        string $message = self::MESSAGE_OK,
        int $status = self::STATUS_OK
    ): JsonResponse {
        $content = ['message' => $message];

        if (
            $data instanceof ResourceCollection 
            &&
            $data->resource instanceof LengthAwarePaginator
        ) {
            if ($data->resource->isEmpty())
                return self::noContent();

            $content['data'] = $data->resource->items();
            $content['meta'] = [
                'total'         => $data->resource->total(),
                'perPage'       => $data->resource->perPage(),
                'currentPage'   => $data->resource->currentPage(),
                'lastPage'      => $data->resource->lastPage(),
            ];
        } elseif ($data instanceof JsonSerializable) {
            $content['data'] = $data->jsonSerialize();
        } elseif ($data instanceof Arrayable) {
            $content['data'] = $data->toArray();
        } else {
            $content['data'] = $data;
        }

        return response()->json($content, $status);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function noContent(): JsonResponse
    {
        $content = ['message' => self::MESSAGE_NO_CONTENT];

        return response()->json($content, self::STATUS_NO_CONTENT);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function abortNotFound(): JsonResponse
    {
        return self::json(
            null,
            self::MESSAGE_NOT_FOUND,
            self::STATUS_NOT_FOUND
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function abortNotAccepted(): JsonResponse
    {
        return self::json(
            null,
            self::MESSAGE_NOT_ACCEPTABLE,
            self::STATUS_NOT_ACCEPTABLE
        );
    }

    /**
     * @param  \Illuminate\Validation\ValidationException  $e
     * @return \Illuminate\Http\JsonResponse
     */
    public static function abortFormInvalid(ValidationException $e): JsonResponse
    {
        $message = null;
        foreach ($e->errors() as $error) {
            $message = $error[0];
            break;
        }

        return self::json(
            ['message' => $message],
            self::MESSAGE_UNPROCESSABLE_ENTITY,
            self::STATUS_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function abortInternalError(Exception $exception): JsonResponse
    {
        return self::json(
            [
                'exception' => [
                    'class'     => get_class($exception),
                    'message'   => $exception->getMessage(),
                ],
            ],
            self::MESSAGE_SERVER_ERROR,
            self::STATUS_SERVER_ERROR
        );
    }
}
