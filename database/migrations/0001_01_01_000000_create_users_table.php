<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->unique(); // Requerido por tu AuthController
            $table->string('email')->unique();
            $table->string('password');
            $table->string('Nickname')->nullable(); // Pongo nullable por si acaso
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Requerido porque el modelo usa SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
