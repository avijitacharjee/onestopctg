<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'product',
            'customer',
            'sale',
            'expense',
            'transfer',
            'return',
            'supplier',
            'report'
        ];
        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
