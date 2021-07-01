@extends('layouts.app')

@section('content')
<x-header icon="fas fa-users" title="Roles del sistema" />
@php
$columns = [
    [ 'title' => 'Nombre',                 'data' => 'name',      'name' => 'name' ],
    [ 'title' => 'Fecha de creación',      'data' => 'created_at',  'name' => 'created_at' ],
    [ 'title' => 'Fecha de actualización', 'data' => 'updated_at',  'name' => 'updated_at' ],
    [ 'title' => 'id',                     'data' => 'DT_RowId',    'name' => 'DT_RowId', 'visible' => false ],
];

$crud = [
    'config_file'   => 'roles.partials.config',
    'uri'           => 'role',
    'crud_template' => 'roles.partials.form',
    'modal' => [
        'id'           => 'roles-crud-modal',
        'size'         => 'md', //xl, lg, sm
        'header_color' => '',
        'create_title' => 'Registrar nuevo rol',
        'update_title' => 'Actualizar datos del rol'
    ]
];

@endphp
<x-datatable
    id="roleTable"
    route="role.list"
    :crud="$crud"
    :columns="$columns"
/>
@stop
