<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name' => 'Administrador']);
        $role2=Role::create(['name' => 'Coordinador']);
        $role3=Role::create(['name' => 'Trabajador']);

        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.delete'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'admin.proyectos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.proyectos.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.proyectos.delete'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.proyectos.update'])->syncRoles([$role1,$role2]);
   
    
    }
}
