@extends('layouts.app')

@section('content')
<x-header icon="fas fa-users" title="Usuarios del sistema" />
@php
$columns = [
    [ 'title' => 'Nombre',                 'data' => 'name',       'name' => 'name' ],
    [ 'title' => 'Correo Electronico',     'data' => 'email',      'name' => 'email' ],
    [ 'title' => 'Fecha de creacion',      'data' => 'created_at', 'name' => 'created_at' ],
    [ 'title' => 'Fecha de actualizacion', 'data' => 'updated_at', 'name' => 'updated_at' ],
    [ 'title' => 'id',                       'data' => 'DT_RowId',   'name' => 'DT_RowId','visible' => false ],
];

$crud = [
    'config_file'   => 'users.partials.config',
    'uri'           => 'user', // user.create
    'crud_template' => 'users.partials.form',
    'modal' => [
        'id'           => 'users-crud-modal',
        'size'         => 'lg', //xl, lg, sm
        'header_color' => '',
        'create_title' => 'Registrar nuevo usuario',
        'update_title' => 'Actualizar datos del usuario'
    ]
];
@endphp

<x-datatable
    id="userTable"
    route="user.list"
    :columns="$columns"
    :crud="$crud"
/>
@endsection
