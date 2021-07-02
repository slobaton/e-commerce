<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Yajra\DataTables\DataTables;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrador');
    }

    public function index()
    {
        return view('roles.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::withCasts([
                'created_at' => 'datetime:d/m/Y H:i:s',
                'updated_at' => 'datetime:d/m/Y H:i:s',
            ])->get();
            return DataTables::of($data)
                ->addcolumn('DT_RowId', function ($role) {
                    return $role->id;
                })
                ->toJson();
        }
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->all());
        return $this->successResponse('Se ha creado el rol');
    }

    public function show(Role $role)
    {
        return $this->successResponse($role);
    }

    public function update(Role $role, RoleRequest $request)
    {
        $role->update($request->all());
        return $this->successResponse('Se ha actualizado al rol');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'ADMIN') {
            throw new \Exception('No puedes eliminar el rol de administrador', 403);
        }

        $role->delete();
        return $this->successResponse('Se ha eliminado el rol');
    }
}
