<?php

namespace App\Http\Controllers\Api;

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
    public function store(AuthRequest $request): JsonResponse
    {
        try {
            $user = $this->authService->login($request->validated());
            return apiSuccessResponse($user, 'User logged in successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Login failed: ' . $e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
            return apiSuccessResponse( 'User logout successfully', 200);
        } catch (\Exception $e) {
            return apiErrorResponse('Logout failed: ' . $e->getMessage(), 400);
        }
    }
}
