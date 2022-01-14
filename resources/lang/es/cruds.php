<?php

return [
    'userManagement' => [
        'title'          => 'Gestión de Usuarios',
        'title_singular' => 'Gestión de Usuarios',
    ],
    'permission' => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'name'                        => 'Name',
            'name_helper'                 => ' ',
            'email'                       => 'Email',
            'email_helper'                => ' ',
            'email_verified_at'           => 'Email verified at',
            'email_verified_at_helper'    => ' ',
            'password'                    => 'Password',
            'password_helper'             => ' ',
            'roles'                       => 'Roles',
            'roles_helper'                => ' ',
            'remember_token'              => 'Remember Token',
            'remember_token_helper'       => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'country'                     => 'Country',
            'country_helper'              => ' ',
            'contact_number'              => 'Contact Number',
            'contact_number_helper'       => ' ',
            'profile_pic'                 => 'Profile Pic',
            'profile_pic_helper'          => ' ',
            'is_profile_completed'        => 'Is Profile Completed',
            'is_profile_completed_helper' => ' ',
            'password_hash'               => 'Password Hash',
            'password_hash_helper'        => ' ',
        ],
    ],
    'bird' => [
        'title'          => 'Bird Master',
        'title_singular' => 'Bird Master',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
        ],
    ],
    'egg' => [
        'title'          => 'Egg Master',
        'title_singular' => 'Egg Master',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'specie' => [
        'title'          => 'Specie Master',
        'title_singular' => 'Specie Master',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'bird'              => 'Bird',
            'bird_helper'       => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Country Master',
        'title_singular' => 'Country Master',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'short_code'        => 'Short Code',
            'short_code_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'userBird' => [
        'title'          => 'User Bird',
        'title_singular' => 'User Bird',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'mutation_name'        => 'Mutation Name',
            'mutation_name_helper' => ' ',
            'specie'               => 'Specie',
            'specie_helper'        => ' ',
            'ring_no'              => 'Ring No',
            'ring_no_helper'       => ' ',
            'gender'               => 'Gender',
            'gender_helper'        => ' ',
            'male_parent'          => 'Male Parent',
            'male_parent_helper'   => ' ',
            'female_parent'        => 'Female Parent',
            'female_parent_helper' => ' ',
            'cage_type'            => 'Cage Type',
            'cage_type_helper'     => ' ',
            'cage_no'              => 'Cage No',
            'cage_no_helper'       => ' ',
            'dob'                  => 'Date of Birth',
            'dob_helper'           => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'created_by'           => 'Created By',
            'created_by_helper'    => ' ',
        ],
    ],
    'breedingPair' => [
        'title'          => 'Breeding Pairs',
        'title_singular' => 'Breeding Pair',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'male_bird'          => 'Male Bird',
            'male_bird_helper'   => ' ',
            'female_bird'        => 'Female Bird',
            'female_bird_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
        ],
    ],
    'breedingHistory' => [
        'title'          => 'Breeding History',
        'title_singular' => 'Breeding History',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'clutch_no'         => 'Clutch No',
            'clutch_no_helper'  => ' ',
            'egg_type'          => 'Egg Type',
            'egg_type_helper'   => ' ',
            'lay_date'          => 'Lay Date',
            'lay_date_helper'   => ' ',
            'hatch_date'        => 'Hatch Date',
            'hatch_date_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
        ],
    ],
];
