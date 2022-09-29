<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthenticationTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponseTrait, AuthenticationTrait;

    public $userRepository;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $requestData = $request->only(
                'name',
                'email',
                'password',
                'password_confirmation'
            );

            $user = $this->userRepository->register($requestData);

            if ($user) {
                if ($token = $this->guard()->attempt($requestData)) {
                    $data =  $this->respondWithToken($token);

                    return self::apiResponseSuccess($data, 'Successfully registered', Response::HTTP_OK);
                }
            }
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if ($token = $this->guard()->attempt(
                $request->only('email', 'password')
            )) {
                $data =  $this->respondWithToken($token);
            } else {

                return self::apiResponseError(null, 'Invalid Email and Password !', Response::HTTP_UNAUTHORIZED);
            }

            return self::apiResponseSuccess($data, 'Logged In Successfully!');
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function refreshToken()
    {
        try {
            $refreshed  = $this->guard()->refresh();
            $data       = $this->respondWithToken($refreshed);

            return self::apiResponseSuccess($data, 'Token Refreshed!');
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            $this->guard()->logout();

            return self::apiResponseSuccess(null, 'Logged out successfully!');
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function profile()
    {
        try {
            $data = $this->guard()->user();

            return self::apiResponseSuccess($data, 'Profile Fetched Successfully!');
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }
}
