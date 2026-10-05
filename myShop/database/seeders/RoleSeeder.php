<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'vendor_manager',
            'product_manager',
            'sales_revenue_manager',
            'payment_manager',
            'vendor',
            'customer'
        ];

        $descriptions = [
            'Holds ultimate platform authority. Manages global settings, system configurations, high-level financials, platform-wide user accounts, and system overrides. ',
            'Manages the vendors',
            'Manages the product',
            'Manages the sales and revenue',
            'Manages the payment of the customer and vendor',
            'Shopping through our platfrom',
            'Sales their product throgh our platfrom'
        ];

        foreach ($roles as $key => $roleName) {
            $roleDesc  = $descriptions[$key];
            Role::firstOrCreate(
                ['name' => $roleName],
                ['description' => $roleDesc]
            );
        }
    }
}
