<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthenticationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponseTrait, AuthenticationTrait;

    public $userRepository;

    /**
     * Create a new UserRepository instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index()
    {
        try {
            return $this->repository->getPaginated();
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
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

            $user->sendEmailVerificationNotification();

            if ($user) {
                if ($token = $this->guard()->attempt($requestData)) {
                    $data =  $this->respondWithToken($token, null);

                    return self::apiResponseSuccess($data, 'Successfully signed up! Please verify your email!', Response::HTTP_OK);
                }
            }
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            // if ($token = $this->guard()->attempt(
            //     $request->only('email', 'password')
            // )) {
            //     $data =  $this->respondWithToken($token);
            // } else {

            //     return self::apiResponseError(null, 'Invalid Email and Password !', Response::HTTP_UNAUTHORIZED);
            // }

            // return self::apiResponseSuccess($data, 'Logged In Successfully!');

            $ttl = config('app.JWT_TTL');

            if ($request->remember_me == true) {
                $ttl = config('app.JWT_REMEMBER_TTL');
            }

            if (!$token = $this->guard()->attempt(
                $request->only('email', 'password')
            )) {

                return self::apiResponseError(null, 'Invalid Email and/or Password !', Response::HTTP_UNAUTHORIZED);
            }


            // $user = $this->guard()->user();
            // if ($user->email_verified_at == null) {
            //     return self::apiResponseError(null, 'Please verify yourr email address and try again!', Response::HTTP_UNAUTHORIZED);
            // }

            // return response()->json($this->respondWithToken($token), 200);
            return self::apiResponseSuccess($this->respondWithToken($token, $ttl), 'Logged In Successfully!');
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function refreshToken()
    {
        try {
            $refreshed  = $this->guard()->refresh();
            $data       = $this->respondWithToken($refreshed, null);

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

    public function isEmailVerified()
    {

        $data = $this->guard()->user();

        try {
            $data = $this->guard()->user();

            $message = 'Email is verified!';

            if ($data->email_verified_at == null) {
                $message = 'Email not verified!';

                return self::apiResponseError(null, $message, Response::HTTP_ACCEPTED);
            }

            return self::apiResponseSuccess($data, $message);
        } catch (\Exception $e) {

            return self::apiServerError($e->getMessage());
        }
    }

    public function verifyEmail(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $expires = Carbon::createFromTimestamp($request->expires);
            $isExpired = Carbon::now()->gt($expires);


            if ($isExpired) {

                return self::apiResponseError(null, 'The link has already expired! Please resend and try again', Response::HTTP_ACCEPTED);
            }

            if ($request->hasValidSignature(false)) {

                if (!$user->email_verified_at == null) {

                    return self::apiResponseError(null, 'This email address is already verified!', Response::HTTP_ACCEPTED);
                }

                $user->email_verified_at = Carbon::now(); // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature

                $user->save();

                return self::apiResponseSuccess($user, 'Email verified Successfully!');
            }

            return self::apiResponseError(null, 'Provided data is not valid!', Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            // throw $th;
            return self::apiServerError($e->getMessage());
        }
    }

    public function resendVerificationEmail(Request $request)
    {

        if ($request->user()->hasVerifiedEmail()) {

            return self::apiResponseError(null, 'User already have verified email!', Response::HTTP_UNAUTHORIZED);
        }

        $request->user()->sendEmailVerificationNotification();

        return self::apiResponseSuccess($request->user, 'The notification has been resubmitted!');
    }
}
