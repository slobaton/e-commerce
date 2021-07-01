<div class="form-group">
    <div class="row">
            @php
                $permissionsType = [];//get_permissionsType();
            @endphp
            @foreach ($permissionsType as $permissionType)
                <div class="col-3">
                    <div class="card m-2">
                        <div class="card-header">
                            <h3 class="card-title float-none text-center font-weight-bold">
                                {{ucfirst($permissionType->type)}}
                            </h3>
                        </div>
                        <div class="card-body">
                            @php
                                $permissions = get_permissions()
                                    ->where('type', $permissionType->type);
                            @endphp
                            @foreach ($permissions as $permission)
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    {{
                                        Form::checkbox(
                                            'permission_id[]',
                                            $permission->name,
                                            false,
                                            ['id'=>$permission->name,'class'=>'custom-control-input'])
                                    }}
                                    {{
                                    Form::label(
                                        $permission->name,
                                        $permission->name,
                                        ['class'=>'custom-control-label'])
                                    }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
