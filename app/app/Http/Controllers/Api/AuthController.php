<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthServices $authService;
    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Display a listing of the resource.
     */
    public function registerView()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(AuthRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->login($request->validated());
            return apiSuccessResponse(new UserResource($user), 'User logged in successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Login failed: ' . $e->getMessage(), 400);
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->registerUser($request->validated());
            return apiSuccessResponse(new UserResource($user), 'User registered successfully', 201);
        } catch (\Exception $e) {
            return apiErrorResponse('Registration failed: ' . $e->getMessage(), 400);
        }
    }


  public function logout(Request $request): JsonResponse
{
    try {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
        $user->currentAccessToken()->delete();
        return apiSuccessResponse(null, 'Successfully logged out', 200);

    } catch (\Exception $e) {
        return apiErrorResponse('logged failed: ' . $e->getMessage(), 400);
    }
}
}
