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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_access',
            ],
            [
                'id'    => 24,
                'title' => 'product_unit_create',
            ],
            [
                'id'    => 25,
                'title' => 'product_unit_edit',
            ],
            [
                'id'    => 26,
                'title' => 'product_unit_show',
            ],
            [
                'id'    => 27,
                'title' => 'product_unit_delete',
            ],
            [
                'id'    => 28,
                'title' => 'product_unit_access',
            ],
            [
                'id'    => 29,
                'title' => 'product_brand_create',
            ],
            [
                'id'    => 30,
                'title' => 'product_brand_edit',
            ],
            [
                'id'    => 31,
                'title' => 'product_brand_show',
            ],
            [
                'id'    => 32,
                'title' => 'product_brand_delete',
            ],
            [
                'id'    => 33,
                'title' => 'product_brand_access',
            ],
            [
                'id'    => 34,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 35,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 36,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 37,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 38,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 39,
                'title' => 'product_attribute_create',
            ],
            [
                'id'    => 40,
                'title' => 'product_attribute_edit',
            ],
            [
                'id'    => 41,
                'title' => 'product_attribute_show',
            ],
            [
                'id'    => 42,
                'title' => 'product_attribute_delete',
            ],
            [
                'id'    => 43,
                'title' => 'product_attribute_access',
            ],
            [
                'id'    => 44,
                'title' => 'product_variation_create',
            ],
            [
                'id'    => 45,
                'title' => 'product_variation_edit',
            ],
            [
                'id'    => 46,
                'title' => 'product_variation_show',
            ],
            [
                'id'    => 47,
                'title' => 'product_variation_delete',
            ],
            [
                'id'    => 48,
                'title' => 'product_variation_access',
            ],
            [
                'id'    => 49,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
