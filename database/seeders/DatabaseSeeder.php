<?php

namespace Database\Seeders;

// Importa o modelo User e o Facade Hash
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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