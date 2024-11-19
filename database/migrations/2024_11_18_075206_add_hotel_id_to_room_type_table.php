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
        Schema::table('room_type', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('hotel_id')->after('id'); // Add hotel_id column after 'id' column
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade'); // Set foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room_type', function (Blueprint $table) {
            //
            $table->dropForeign(['hotel_id']); // Drop the foreign key constraint
            $table->dropColumn('hotel_id'); // Drop the hotel_id column
        });
    }
};
