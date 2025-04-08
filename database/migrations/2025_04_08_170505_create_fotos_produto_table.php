<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fotos_produto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->string('arquivo'); // Nome do arquivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos_produto');
    }
};
