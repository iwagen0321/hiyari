<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('employee_number')->after('id');
            $table->string('family_name')->after('name');
            $table->string('first_name')->after('family_name');
            $table->string('division_name')->after('first_name');
            $table->boolean('role')->after('password');
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
            $table->dropColumn('employee_number');
            $table->dropColumn('family_name');
            $table->dropColumn('first_name');
            $table->dropColumn('division_name');
            $table->dropColumn('role');
        });
    }
};
