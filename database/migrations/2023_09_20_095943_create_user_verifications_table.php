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
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('method');
            $table->string('sender');
            $table->string('receiver');
            $table->string('token');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('created_at');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expired_at');
            $table->foreignId('banded_by')->nullable()->constrained('users');
            $table->timestamp('banded_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_verifications');
    }
};
