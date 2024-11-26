<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Adiciona a coluna 'user_id'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Define a chave estrangeira
            $table->string('model');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('action'); // create, update, delete
            $table->json('changes')->nullable(); // Registra mudanças
            $table->string('query')->nullable(); // Query da pesquisa, se houver
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
