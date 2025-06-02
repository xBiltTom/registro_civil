<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        Permission::create(['name' => 'ver roles']);
        Permission::create(['name' => 'crear roles']);
        Permission::create(['name' => 'editar roles']);
        Permission::create(['name' => 'eliminar roles']);
        Permission::create(['name' => 'ver permisos']);
        Permission::create(['name' => 'crear permisos']);
        Permission::create(['name' => 'editar permisos']);
        Permission::create(['name' => 'eliminar permisos']);
        Permission::create(['name' => 'ver personas']);
        Permission::create(['name' => 'crear personas']);
        Permission::create(['name' => 'editar personas']);
        Permission::create(['name' => 'eliminar personas']);
        Permission::create(['name' => 'ver lugares']);
        Permission::create(['name' => 'crear lugares']);
        Permission::create(['name' => 'editar lugares']);
        Permission::create(['name' => 'eliminar lugares']);
        Permission::create(['name' => 'ver configuraciones']);
        Permission::create(['name' => 'editar configuraciones']); 

        $adminUser = User::query()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'persona_id' => 1,
            'ruta_foto' => null,
            'estado' => 1,
        ]);
        $roleAdmin = Role::create(['name' => 'admin']);
        $adminUser->assignRole($roleAdmin);
        $permissionsAdmin = Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionsAdmin);
    }
}
