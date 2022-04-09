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
                'title' => 'product_unit_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_unit_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_unit_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_unit_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_unit_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_brand_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_brand_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_brand_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_brand_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_brand_access',
            ],
            [
                'id'    => 33,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 34,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 35,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 36,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 37,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 38,
                'title' => 'product_attribute_create',
            ],
            [
                'id'    => 39,
                'title' => 'product_attribute_edit',
            ],
            [
                'id'    => 40,
                'title' => 'product_attribute_show',
            ],
            [
                'id'    => 41,
                'title' => 'product_attribute_delete',
            ],
            [
                'id'    => 42,
                'title' => 'product_attribute_access',
            ],
            [
                'id'    => 43,
                'title' => 'product_variation_create',
            ],
            [
                'id'    => 44,
                'title' => 'product_variation_edit',
            ],
            [
                'id'    => 45,
                'title' => 'product_variation_show',
            ],
            [
                'id'    => 46,
                'title' => 'product_variation_delete',
            ],
            [
                'id'    => 47,
                'title' => 'product_variation_access',
            ],
            [
                'id'    => 48,
                'title' => 'product_create',
            ],
            [
                'id'    => 49,
                'title' => 'product_edit',
            ],
            [
                'id'    => 50,
                'title' => 'product_show',
            ],
            [
                'id'    => 51,
                'title' => 'product_delete',
            ],
            [
                'id'    => 52,
                'title' => 'product_access',
            ],
            [
                'id'    => 53,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 54,
                'title' => 'master_access',
            ],
            [
                'id'    => 55,
                'title' => 'city_create',
            ],
            [
                'id'    => 56,
                'title' => 'city_edit',
            ],
            [
                'id'    => 57,
                'title' => 'city_show',
            ],
            [
                'id'    => 58,
                'title' => 'city_delete',
            ],
            [
                'id'    => 59,
                'title' => 'city_access',
            ],
            [
                'id'    => 60,
                'title' => 'sales_person_create',
            ],
            [
                'id'    => 61,
                'title' => 'sales_person_edit',
            ],
            [
                'id'    => 62,
                'title' => 'sales_person_show',
            ],
            [
                'id'    => 63,
                'title' => 'sales_person_delete',
            ],
            [
                'id'    => 64,
                'title' => 'sales_person_access',
            ],
            [
                'id'    => 65,
                'title' => 'sales_order_create',
            ],
            [
                'id'    => 66,
                'title' => 'sales_order_edit',
            ],
            [
                'id'    => 67,
                'title' => 'sales_order_show',
            ],
            [
                'id'    => 68,
                'title' => 'sales_order_delete',
            ],
            [
                'id'    => 69,
                'title' => 'sales_order_access',
            ],
            [
                'id'    => 70,
                'title' => 'sales_order_detail_create',
            ],
            [
                'id'    => 71,
                'title' => 'sales_order_detail_edit',
            ],
            [
                'id'    => 72,
                'title' => 'sales_order_detail_show',
            ],
            [
                'id'    => 73,
                'title' => 'sales_order_detail_delete',
            ],
            [
                'id'    => 74,
                'title' => 'sales_order_detail_access',
            ],
            [
                'id'    => 75,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
