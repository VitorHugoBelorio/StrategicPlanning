<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cria um usuário inicial
        User::create([
            'name' => 'Root User',
            'email' => 'root@gmail.com',
            'password' => Hash::make('123456'), // Criptografa a senha
            'email_verified_at' => now(), // Define a data de verificação como agora
        ]);

        // Você pode adicionar mais seeders aqui, se tiver outros
        // $this->call(OtherSeeder::class);
    }
}