<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allUsers()
    {
        try{
            $allUsers = $this->repository->getAllUsers();
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => UserResource::collection($allUsers)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 401,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function addUser(UserRequest $request)
    {
        try{
            $validatedUserData = $request->validated();
            $validatedUserData['password'] = Hash::make($request->password);
            $createdUserData = $this->repository->createUser($validatedUserData);

            return response()->json([
                'status_code'=> 201,
                'message' => 'Data saved successfully',
                'data' => new UserResource($createdUserData)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code'=> 500,
                'error' => $e->getMessage()
            ]);
        }

    }

    public function findUserById($userId)
    {
        try{
            $findUserById = $this->repository->getUserById($userId);
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => new UserResource($findUserById)
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => 'failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateUser($userId, UpdateUserRequest $request)
    {
        try{
            $validatedUserData = $request->validated();
            $this->repository->updateUser($userId, $validatedUserData);
            $findUserById = User::where('id', $userId)->first();
            return response()->json([
                'status_code' => 201,
                'message' => 'User updated successfully.',
                'data' => new UserResource($findUserById)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 500,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroyUser($userId)
    {
        try{
            $this->repository->deleteUser($userId);
            return response()->json([
                'status_code' => 201,
                'message' => 'User successfully deleted'
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 204,
                'Message' => 'This resource does not exist.'
            ]);
        }
    }

    public function assignRoleToUser($user, $role)
    {
        try{
            $userId = User::where('id', $user)->first();
            $roleId = Role::where('id', $role)->first();
            $assignRoleToUser = $this->repository->assignRole($userId, $roleId);
            return response()->json([
                'status_code' =>  'Success!',
                'message' => 'Role has been successfully assigned'
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' => '404',
                'message' => 'Failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function searchData(Request $request)
    {
        try{
            $search = $request->input('search');
            if($search){
                $userSearchResult = User::with('roles')
                ->where('name', 'LIKE', '%'.$search.'%')->orWhere('email', 'LIKE', '%'.$search.'%')->get();
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => UserResource::collection($userSearchResult)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code'=> '404',
                'message' => 'Not found',
                'error' => $e->getMessage()
            ]);
        }

    }
}
