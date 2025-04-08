<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Opcional: criar um usuário de teste
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Chama os seeders necessários
        $this->call([
            CidadeSeeder::class,
            ProdutoSeeder::class,
        ]);
    }
}
