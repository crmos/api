<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u',
            'timer' => 'r,u,d',
            'projects' => 'c,r,u,d',
            'content-task' => 'c,r,u,d',
            'assigned-content-task' => 'c,r,u,d',
            'task' => 'c,r,u,d',
            'leads' => 'c,r,u,d',
            'sales' => 'c,r,u,d',
            'backup' => 'r,u',
            'export' => 'r',
            'task-checklist' => 'c,r,u,d',
            'global-search' => 'r',
            'chat' => 'r,u,d',
            'calendar' => 'c,r,u,d'

        ],
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
