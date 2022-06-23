<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function createRole(array $roleData);
    public function getRoleById($roleId);
    public function updateRole($roleId, array $roleData);
    public function deleteRole($roleId);
}
