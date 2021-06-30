<div class="form-row">
    @php
    $roles = get_roles();
    @endphp
    @foreach ($roles as $role)
    <div class="form-group col">
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            {{
                Form::checkbox(
                    'role_id[]',
                    $role->name,
                    false,
                    ['id' => $role->name, 'class' => 'custom-control-input'])
            }}
            {{
                Form::label(
                $role->name,
                $role->name,
                ['class'=>'custom-control-label'])
            }}
        </div>
    </div>
    @endforeach
</div>
