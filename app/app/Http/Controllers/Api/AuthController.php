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
    public function index()
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
            // Get the authenticated user via guard

            $user = Auth::guard('api')->user();
            dd($user);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No authenticated user'
                ], 401);
            }

            // Revoke the token that was used for authentication
            $request->user()->token()->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);

            return response()->json(['message' => 'Successfully logged out']);
            $this->authService->logout();
            return apiSuccessResponse('User logout successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Logout failed: ' . $e->getMessage(), 400);
        }
    }
}
