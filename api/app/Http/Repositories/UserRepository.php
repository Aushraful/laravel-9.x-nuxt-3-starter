<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\User  $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register(array $data)
    {
        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ];
        $user = $this->model->create($data);

        return $user;
    }
}
