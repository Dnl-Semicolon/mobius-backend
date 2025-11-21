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
        Schema::create('cup_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bin_session_id')
                ->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('bin_id')->nullable();
            $table->string('brand')->nullable();        // Chagee, Mixue...
            $table->string('material')->nullable();     // paper, plastic, other
            $table->boolean('has_lid')->default(false);
            $table->string('lid_material')->nullable(); // plastic, paper, none
            $table->boolean('has_straw')->default(false);
            $table->string('straw_material')->nullable();
            $table->float('confidence')->default(0);
            $table->integer('points_awarded')->default(0);
            $table
                ->foreign('bin_session_id')
                ->references('id')
                ->on('bin_sessions')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cup_events');
    }
};
