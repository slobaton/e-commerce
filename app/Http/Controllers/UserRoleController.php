<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRoleRequest;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrador');
    }

    public function update(User $userRole, UserRoleRequest $request)
    {
        $userRole->syncRoles($request->role_id);
        return $this->successResponse('Se ha realizado la asignación');
    }

    public function show(User $userRole)
    {
        $userWithRoles = $userRole->roles;
        return $this->successResponse($userWithRoles);
    }
}
