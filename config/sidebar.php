<?php
$id = 1;

return [
    [
        'id' => $id++,
        'title' => 'Dashboard',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['*'],
        'route' => 'dashboard',                            // top-level link (null == '#!')
        // 'submenu' => [
        //     ['title' => 'Profile','route' => 'dashboard'],

        // ],
    ],
    [
        'id' => $id++,
        'title' => 'Check In/Check Out',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['*'],
        'route' => 'check-in-out',
    ],
    [
        'id' => $id++,
        'title' => 'Country',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.country.index',
    ],
    [
        'id' => $id++,
        'title' => 'Bussiness Unit',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.bussiness-unit.index',
    ],
    [
        'id' => $id++,
        'title' => 'Department',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.department.index',
    ],
    [
        'id' => $id++,
        'title' => 'Users',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.user.index',
    ],

    [
        'id' => $id++,
        'title' => 'Roles',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.role.index',
    ],

    [
        'id' => $id++,
        'title' => 'Leave Types',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['admin'],
        'route' => 'admin.leave-types.index',

    ],
    [
        'id' => $id++,
        'title' => 'Leave',
        'icon' => 'ph-duotone ph-gauge',
        'roles' => ['*'],
        'route' => 'leaves.index',

    ],


];
