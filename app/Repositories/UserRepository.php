<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class userRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::with('roles')->get();
    }

    public function createUser(array $createdUserData)
    {
        return User::create($createdUserData);
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function updateUser($userId, array $updatedUserData)
    {
        return User::whereId($userId)->update($updatedUserData);
    }


    public function deleteUser($userId)
    {
        //$findUserById = User::findOrFail($userId);
        return User::findOrFail($userId)->delete();
    }

    public function assignRole($userId, $roleId)
    {
        $assignRoleToUser = $userId->roles()->attach($roleId);
        return $assignRoleToUser;
    }

}
