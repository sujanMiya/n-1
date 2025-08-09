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
if (!function_exists('str_unique')) {
    /**
     * @param int $length
     * @return string
     */
    function str_unique(int $length = 16): string
    {
        $side = rand(0, 1); // 0 = left, 1 = right
        $salt = rand(0, 9);
        $len = $length - 1;
        $string = Str::random($len <= 0 ? 7 : $len);

        $separatorPos = (int)ceil($length / 4);

        $string = $side === 0 ? ($salt . $string) : ($string . $salt);
        $string = substr_replace($string, '-', $separatorPos, 0);

        return substr_replace($string, '-', negative_value($separatorPos), 0);
    }
} 
if (!function_exists('negative_value')) {
    /**
     * @param int|float $value
     * @param bool $float
     * @return int|float
     */
    function negative_value(int|float $value, bool $float = false): int|float
    {
        if ($float) {
            $value = (float)$value;
        }

        return 0 - abs($value);
    }
}
if (!function_exists('str_unique_with_prefix')) {

    function str_unique_with_prefix($prefix = ''): string
    {
        return $prefix . str_unique();
    }
}
if (!function_exists('cursor_pagination_meta')) {

    /**
     * @param CursorPaginator $paginator
     * @return array
     */
    function cursor_pagination_meta(CursorPaginator $paginator): array
    {
        return [
            'path' => $paginator->path(),
            'per_page' => $paginator->perPage(),
            'next_cursor' => $paginator->nextCursor()?->encode(),
            'next_page_url' => $paginator->nextPageUrl(),
            'prev_cursor' => $paginator->previousCursor()?->encode(),
            'prev_page_url' => $paginator->previousPageUrl(),
        ];
    }
}
