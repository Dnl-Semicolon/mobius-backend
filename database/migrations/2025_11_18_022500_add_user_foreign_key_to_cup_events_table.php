<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cup_events', function (Blueprint $table) {
            if (!Schema::hasColumn('cup_events', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('bin_session_id');
            }

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('cup_events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
