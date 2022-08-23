<?php

namespace App\API\V1\Controllers;

use App\API\V1\Requests\Auth\LoginApiUser;
use App\API\V1\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class JwtAuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post  (
     *      tags={"Authentication"},
     *      path="/auth/login",
     *      summary="Get a JWT via given credentials.",
     *      @OA\RequestBody(
     *          request="LoginRequest",
     *          description="Auth request fields",
     *          @OA\JsonContent(
     *              type="object",
     *              required={"login", "password"},
     *              @OA\Property(property="login", type="string", example="login"),
     *              @OA\Property(property="password", type="string", example="password"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success auth response",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="User not authorized. Wrong login or password.",
     *          @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors.",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginApiUser $request)
    {

        $credentials = $request->only(['login', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->respondUnAuthorized();
        }

        return $this->respondWithResource(JsonResource::make($this->respondWithToken($token)));
    }

    /**
     * @OA\Post  (
     *      tags={"Authentication"},
     *      path="/auth/user",
     *      summary="Get the authenticated User.",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful response with user data",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return $this->respondWithResource(JsonResource::make(auth('api')->user()));
    }

    /**
     * @OA\Post  (
     *      tags={"Authentication"},
     *      path="/auth/logout",
     *      summary="Log the user out (Invalidate the token).",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful logout response",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return $this->respondSuccess('Successfully logged out');
    }

    /**
     * @OA\Post  (
     *      tags={"Authentication"},
     *      path="/auth/refresh",
     *      summary="Refresh a token.",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful response with a new token.",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $response = $this->respondWithToken(auth('api')->refresh());
        return $this->respondWithResource(JsonResource::make($response));
    }

    /**
     *
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}
