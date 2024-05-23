<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        //admin permissions
        $itemUpdatePermission = Permission::create(['name' => 'item_update']);
        $photoDestroyPermission = Permission::create(['name' => 'photo_destroy']);
        $photoStorePermission = Permission::create(['name' => 'photo_store']);
        $userDestroyPermission = Permission::create(['name' => 'user_destroy']);
        $categoryDestroyPermission = Permission::create(['name' => 'category_destroy']);
        $categoryCreatePermission = Permission::create(['name' => 'category_create']);
        $itemStorePermission = Permission::create(['name' => 'item_store']);
        $itemDestroyPermission = Permission::create(['name' => 'item_destroy']);

        //user permissions
        $cardAddPermission = Permission::create(['name' => 'card_add']);
        $cardRemovePermission = Permission::create(['name' => 'card_remove']);
        $orderCardPermission = Permission::create(['name' => 'order_card']);
        $contactSendPermission = Permission::create(['name' => 'contact_send']);

        //Assign permissions to roles
        $adminRole->givePermissionTo([$itemUpdatePermission, $photoDestroyPermission, $photoStorePermission, $userDestroyPermission,
            $categoryDestroyPermission, $categoryCreatePermission, $itemStorePermission, $itemDestroyPermission]);
        $userRole->givePermissionTo([$cardAddPermission, $cardRemovePermission, $orderCardPermission, $contactSendPermission]);
    }
}
