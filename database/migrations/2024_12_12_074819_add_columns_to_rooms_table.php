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
        Schema::table('rooms', function (Blueprint $table) {
            //
            $table->boolean('breakfast')->default(0);
            $table->string('breakfast_type')->nullable();
            $table->decimal('breakfast_price', 8, 2)->nullable();

            $table->boolean('lunch')->default(0);
            $table->string('lunch_type')->nullable();
            $table->decimal('lunch_price', 8, 2)->nullable();

            $table->boolean('dinner')->default(0);
            $table->string('dinner_type')->nullable();
            $table->decimal('dinner_price', 8, 2)->nullable();

            $table->boolean('breakfast_included')->default(0);

            $table->string('event')->nullable();
            $table->string('event_type')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('event_date_range')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn([
                'breakfast',
                'breakfast_type',
                'breakfast_price',
                'lunch',
                'lunch_type',
                'lunch_price',
                'dinner',
                'dinner_type',
                'dinner_price',
                'breakfast_included',
                'event',
                'event_type',
                'price',
                'event_date_range'
            ]);
        });
    }
};
