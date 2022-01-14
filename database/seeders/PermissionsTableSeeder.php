<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'bird_create',
            ],
            [
                'id'    => 18,
                'title' => 'bird_edit',
            ],
            [
                'id'    => 19,
                'title' => 'bird_show',
            ],
            [
                'id'    => 20,
                'title' => 'bird_delete',
            ],
            [
                'id'    => 21,
                'title' => 'bird_access',
            ],
            [
                'id'    => 22,
                'title' => 'egg_create',
            ],
            [
                'id'    => 23,
                'title' => 'egg_edit',
            ],
            [
                'id'    => 24,
                'title' => 'egg_show',
            ],
            [
                'id'    => 25,
                'title' => 'egg_delete',
            ],
            [
                'id'    => 26,
                'title' => 'egg_access',
            ],
            [
                'id'    => 27,
                'title' => 'specie_create',
            ],
            [
                'id'    => 28,
                'title' => 'specie_edit',
            ],
            [
                'id'    => 29,
                'title' => 'specie_show',
            ],
            [
                'id'    => 30,
                'title' => 'specie_delete',
            ],
            [
                'id'    => 31,
                'title' => 'specie_access',
            ],
            [
                'id'    => 32,
                'title' => 'country_create',
            ],
            [
                'id'    => 33,
                'title' => 'country_edit',
            ],
            [
                'id'    => 34,
                'title' => 'country_show',
            ],
            [
                'id'    => 35,
                'title' => 'country_delete',
            ],
            [
                'id'    => 36,
                'title' => 'country_access',
            ],
            [
                'id'    => 37,
                'title' => 'user_bird_create',
            ],
            [
                'id'    => 38,
                'title' => 'user_bird_edit',
            ],
            [
                'id'    => 39,
                'title' => 'user_bird_show',
            ],
            [
                'id'    => 40,
                'title' => 'user_bird_delete',
            ],
            [
                'id'    => 41,
                'title' => 'user_bird_access',
            ],
            [
                'id'    => 42,
                'title' => 'breeding_pair_create',
            ],
            [
                'id'    => 43,
                'title' => 'breeding_pair_edit',
            ],
            [
                'id'    => 44,
                'title' => 'breeding_pair_show',
            ],
            [
                'id'    => 45,
                'title' => 'breeding_pair_delete',
            ],
            [
                'id'    => 46,
                'title' => 'breeding_pair_access',
            ],
            [
                'id'    => 47,
                'title' => 'breeding_history_create',
            ],
            [
                'id'    => 48,
                'title' => 'breeding_history_edit',
            ],
            [
                'id'    => 49,
                'title' => 'breeding_history_show',
            ],
            [
                'id'    => 50,
                'title' => 'breeding_history_delete',
            ],
            [
                'id'    => 51,
                'title' => 'breeding_history_access',
            ],
            [
                'id'    => 52,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
