<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('type', ['administrator', 'user', 'provider'])->after('id');
            $table->string('middlename')->after('name');
            $table->string('lastname')->after('middlename');
            $table->integer('phone')->nullable()->unsigned()->after('lastname');
            $table->integer('mobile')->nullable()->unsigned()->after('phone');
            $table->string('address_street')->nullable()->after('mobile');
            $table->string('address_number')->nullable()->after('address_street');
            $table->string('address_suburb')->nullable()->after('address_number');
            $table->string('address_zip')->nullable()->after('address_suburb');
            $table->string('address_reference')->nullable()->after('address_zip');
            $table->string('address_city')->nullable()->after('address_reference');
            $table->string('address_state')->nullable()->after('address_city');
            $table->string('address_country')->nullable()->after('address_state');
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
            //
        });
    }
}
