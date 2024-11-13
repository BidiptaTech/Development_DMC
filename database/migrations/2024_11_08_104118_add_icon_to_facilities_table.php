<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconToFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Add the icon column after the name column
            $table->string('icon')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Rollback the change
            $table->dropColumn('icon');
        });
    }
}
