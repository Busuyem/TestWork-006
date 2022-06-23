<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Repositories\RoleRepository;
use App\Http\Requests\UpdateRoleRequest;
use App\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{
    public $repository;

    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allRoles()
    {
        try{
            $allRoles = $this->repository->getAllRoles();
            return response()->json([
                'status_code' => 200,
                'message' => 'Success!',
                'data'=> RoleResource::collection($allRoles)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => 'fail!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function addRole(RoleRequest $request)
    {
        try{
            $validatedRoleData = $request->validated();
            $createdData = $this->repository->createRole($validatedRoleData);
            return response()->json([
                'status_code' => '201',
                'message' => 'Success!',
                'data' => new RoleResource($createdData)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message' => 'failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function findRoleById($roleId)
    {
        try{
            $findRoleById = $this->repository->getRoleById($roleId);
            return response()->json([
                'status_code' => 201,
                'message' => 'Success!',
                'data' => new RoleResource($findRoleById)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateRole($roleId, UpdateRoleRequest $request)
    {
        try{
            $validatedRoleData = $request->validated();
            $this->repository->updateRole($roleId, $validatedRoleData);
            $findRoleById = Role::where('id', $roleId)->first();
            return response()->json([
                'status_code' => 201,
                'message' => 'Role updated successfully',
                'data' => new RoleResource($findRoleById)
            ]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Role updated successfully.',
                'data' => new RoleResource($findRoleById)
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message' => 'Failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroyRole($roleId)
    {
        try{
            $this->repository->deleteRole($roleId);
            return response()->json([
                'status_code' => 200,
                'message' => 'Role deleted successfully',
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => 'Resource does not exist',
                'error' => $e->getMessage()
            ]);
        }
    }
}
