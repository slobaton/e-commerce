<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct() {
        // $this->middleware('permission:view-user', ['only' => ['index', 'list']]);
        // $this->middleware('permission:create-user', ['only' => ['store']]);
        // $this->middleware('permission:edit-user', ['only' => ['show', 'update']]);
        // $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('users.index');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return DataTables::of($data)
                ->addcolumn('DT_RowId', function ($row) {
                    return $row->id;
                })
                ->toJson();
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(UserRequest $request)
    {
        User::create($request->all());
        return $this->successResponse('Usuario creado con éxito');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return $this->successResponse($user, 200);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return $this->successResponse('El usuario ha sido actualizado');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->successResponse('El usuario se ha sido eliminado');
    }

}
