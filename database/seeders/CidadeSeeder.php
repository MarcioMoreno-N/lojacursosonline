<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    public function run()
    {
        $cidades = [
            // Cidades da região de Caçador (SC)
            ['nome' => 'Caçador', 'estado' => 'SC'],
            ['nome' => 'Videira', 'estado' => 'SC'],
            ['nome' => 'Fraiburgo', 'estado' => 'SC'],
            ['nome' => 'Lebon Régis', 'estado' => 'SC'],
            ['nome' => 'Rio das Antas', 'estado' => 'SC'],

            // Principais cidades do Brasil
            ['nome' => 'São Paulo', 'estado' => 'SP'],
            ['nome' => 'Rio de Janeiro', 'estado' => 'RJ'],
            ['nome' => 'Belo Horizonte', 'estado' => 'MG'],
            ['nome' => 'Porto Alegre', 'estado' => 'RS'],
            ['nome' => 'Curitiba', 'estado' => 'PR'],
            ['nome' => 'Florianópolis', 'estado' => 'SC'],
            ['nome' => 'Salvador', 'estado' => 'BA'],
            ['nome' => 'Brasília', 'estado' => 'DF'],
            ['nome' => 'Fortaleza', 'estado' => 'CE'],
            ['nome' => 'Recife', 'estado' => 'PE'],
            ['nome' => 'Manaus', 'estado' => 'AM'],
            ['nome' => 'Goiânia', 'estado' => 'GO'],
            ['nome' => 'Campinas', 'estado' => 'SP'],
            ['nome' => 'São Luís', 'estado' => 'MA'],
        ];

        foreach ($cidades as $cidade) {
            Cidade::create($cidade);
        }
    }
}
