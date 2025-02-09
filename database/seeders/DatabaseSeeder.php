<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // \App\Models\User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin12345678'),
        // ]);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'publisher']);

        // $user = User::find(1); // Encuentra al primer usuario registrado
        // $user->assignRole($roleAdmin);
        $this->call([
            OptionSeeder::class,
            // Puedes llamar a otros seeders aquí si los tienes
        ]);
    }
}
