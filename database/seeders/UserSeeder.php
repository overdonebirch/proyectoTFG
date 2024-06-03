<?php

namespace Database\Seeders;

use App\Models\Gimnasio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $gimnasio = Gimnasio::where("nombre", "Vitality Parla")->first();

        $user = User::create([
            "nombre" => "andres",
            "apellidos" => "empleado",
            "email" => "andres@gmail.com",
            "dni" => "02341071C",
            "password" => Hash::make("adm"),
            "id_gimnasio" => $gimnasio->_id,  // Use _id for MongoDB
            "fecha_registro" => "2024-06-03",
            "empleado" => false,
            "administrador" => true,
        ]);


    }
}
