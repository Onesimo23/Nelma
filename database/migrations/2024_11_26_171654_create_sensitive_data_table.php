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
        Schema::create('sensitive_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('encrypted_data'); // Dado criptografado
            $table->string('hashed_data'); // Dado com hash
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensitive_data');
    }
};
