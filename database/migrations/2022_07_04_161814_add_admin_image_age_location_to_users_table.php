<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminImageAgeLocationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('name');
            $table->string('profile_image')->nullable()->after('name');
            $table->string('location')->after('name');
            $table->integer('age')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin']);
            $table->dropColumn(['profile_image']);
            $table->dropColumn(['location']);
            $table->dropColumn(['age']);
        });
    }
}
