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
        Schema::table('beds', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('room_id');
            
            // King Bed Columns
            $table->integer('king_bed_no_of_rooms')->default(0);
            $table->integer('king_bed_max_occupancy')->default(0);
            $table->integer('king_bed_adult_count')->default(0);
            $table->integer('king_bed_child_count')->default(0);
            $table->integer('king_bed_extra_bed')->default(0);
            $table->decimal('king_bed_extra_bed_price', 8, 2)->default(0);
            $table->boolean('king_bed_baby_cot')->nullable();
            $table->decimal('king_bed_baby_cot_price', 8, 2)->default(0);

            // Queen Bed Columns
            $table->integer('queen_bed_no_of_rooms')->default(0);
            $table->integer('queen_bed_max_occupancy')->default(0);
            $table->integer('queen_bed_adult_count')->default(0);
            $table->integer('queen_bed_child_count')->default(0);
            $table->integer('queen_bed_extra_bed')->default(0);
            $table->decimal('queen_bed_extra_bed_price', 8, 2)->default(0);
            $table->integer('queen_bed_baby_cot')->default(0);
            $table->decimal('queen_bed_baby_cot_price', 8, 2)->default(0);

            // Twin Bed Columns
            $table->integer('twin_bed_no_of_rooms')->default(0);
            $table->integer('twin_bed_max_occupancy')->default(0);
            $table->integer('twin_bed_adult_count')->default(0);
            $table->integer('twin_bed_child_count')->default(0);
            $table->integer('twin_bed_extra_bed')->default(0);
            $table->decimal('twin_bed_extra_bed_price', 8, 2)->default(0);
            $table->integer('twin_bed_baby_cot')->default(0);
            $table->decimal('twin_bed_baby_cot_price', 8, 2)->default(0);
            // Foreign key constraint
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beds', function (Blueprint $table) {
            //
        });
    }
};
