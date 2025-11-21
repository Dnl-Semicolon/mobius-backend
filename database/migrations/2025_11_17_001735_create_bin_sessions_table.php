<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bin_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('bin_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status');
            $table->integer('total_points')->default(0);
            $table->string('claim_token')->nullable()->unique();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bin_sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('bin_sessions');
    }
};
