<?php 

declare(strict_types=1);
use Illuminate\Http\JsonResponse;
/**
 * Helper functions for the application.
 *
 * @package App\Helpers
 */
if(!function_exists('apiSuccessResponse')) {
    /**
     * Returns a standardized success response.
     *
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function apiSuccessResponse($data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'status_code' => $statusCode,
            'data' => $data,
        ]);
    }
}
if(!function_exists('apiErrorResponse')) {
    /**
     * Returns a standardized error response.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    function apiErrorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}   
