<?php

namespace App\Traits;

trait AuthenticationTrait
{



    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return auth()->guard('api');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $ttl)
    {
        $data = [[
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => $ttl ?? config('app.JWT_TTL'),
            'user'          => $this->guard()->user()
        ]];

        return $data[0];
    }
}
