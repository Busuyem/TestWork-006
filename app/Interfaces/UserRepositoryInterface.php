<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function createUser(array $createdUserData);
    public function getUserById($userId);
    public function updateUser($userId, array $updatedUserData);
    public function deleteUser($userId);
    public function assignRole($userId, $roleId);
}
