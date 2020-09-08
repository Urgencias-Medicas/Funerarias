<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        
        Role::create(['name' => 'Agente']);
        /** @var \App\User $user */
        $agente = factory(\App\User::class)->create();
        
        $agente->assignRole('Agente');

        Role::create(['name' => 'Personal']);
        $personal = factory(\App\User::class)->create();
        
        $personal->assignRole('Personal');

        Role::create(['name' => 'Funeraria']);
        $funeraria = factory(\App\User::class)->create();
        
        $funeraria->assignRole('Funeraria');

        Role::create(['name' => 'Super Admin']);

        /** @var \App\User $user */
        $admin = factory(\App\User::class)->create([
            'name' => 'test',
            'email' => 'admin@test.com',
        ]);

        $admin->assignRole('Super Admin');
    }
}
