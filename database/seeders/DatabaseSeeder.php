<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(TipoClaseSeeder::class);
        // $this->call(GimnasioSeeder::class);
        // $this->call(MembresiaSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ClaseSeeder::class);
        $this->call(ReservasSeeder::class);

    }
}
