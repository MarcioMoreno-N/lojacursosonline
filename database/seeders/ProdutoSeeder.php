<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Str;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $categoria = Categoria::firstOrCreate(['nome' => 'Programação']);

        $cursos = [
            ['Laravel Essencial', 'Curso completo de Laravel 10'],
            ['PHP Moderno', 'Curso avançado de PHP 8 com práticas modernas'],
            ['JavaScript Completo', 'Do básico ao avançado com projetos reais'],
            ['HTML e CSS', 'Curso para criar páginas web modernas e responsivas'],
        ];

        foreach ($cursos as [$nome, $descricao]) {
            Produto::create([
                'nome' => $nome,
                'descricao' => $descricao,
                'slug' => Str::slug($nome),
                'quantidade' => rand(10, 100),
                'valor' => rand(100, 300),
                'categoria_id' => $categoria->id,
            ]);
        }
    }
}
