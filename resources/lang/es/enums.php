<?php

use App\Enums\UserType;

return [

    'user-type' => [
        UserType::Admin => 'Administrador',
        UserType::Business => 'Negocio',
        UserType::Common => 'Común',
    ],
];
