<?php
namespace App\Repositories;
use App\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::with('users')->get();
    }

    public function createRole(array $createdRoleData)
    {
        return Role::create($createdRoleData);
    }

    public function getRoleById($roleId)
    {
        return Role::findOrFail($roleId);
    }

    public function updateRole($roleId, array $updatedRoleData)
    {
        return Role::whereId($roleId)->first()->update($updatedRoleData);
    }


    public function deleteRole($roleId)
    {
        //$findUserById = Role::findOrFail($userId);
        return Role::findOrFail($roleId)->delete();
    }
}
