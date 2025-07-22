<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('phone')->after('password');
            $table->unsignedBigInteger('position_id')->after('phone');
            $table->unsignedBigInteger('department_id')->after('position_id');
            $table->unsignedBigInteger('bussiness_unit_id')->after('department_id');
            $table->unsignedBigInteger('country_id')->after('bussiness_unit_id');
            $table->integer('is_department_head')->after('country_id')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
