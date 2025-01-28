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
        $role1 = Role::create(['name' => 'Desarrollador']);
        $role2 = Role::create(['name' => 'Administrador']);
        $role3 = Role::create(['name' => 'Contable']);
        $role4 = Role::create(['name' => 'Recursos Humanos']);
        $role5 = Role::create(['name' => 'Visitante']);
        
        Permission::create(['name' => 'desarrollo']);
        Permission::create(['name' => 'contable']);
        Permission::create(['name' => 'recursos_humanos']);
        Permission::create(['name' => 'visitante']);
        
        $role1->givePermissionTo(['desarrollo', 'contable', 'recursos_humanos', 'visitante']);
        $role2->givePermissionTo(['contable', 'recursos_humanos', 'visitante']);
        $role3->givePermissionTo('contable');
        $role4->givePermissionTo('recursos_humanos');
        $role5->givePermissionTo('visitante');
    }
}
