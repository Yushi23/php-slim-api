<?php

use App\Database;

return [
    Database::class => function () {
        return new Database(host: 'db_host', name: 'db_name', user: 'db_user', password: 'db_password');
    }
];