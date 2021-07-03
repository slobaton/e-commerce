<?php

use App\Models\Role;

if (!function_exists('get_roles')) {
    function get_roles()
    {
        $roles = Role::all();
        return $roles;
    }
}
