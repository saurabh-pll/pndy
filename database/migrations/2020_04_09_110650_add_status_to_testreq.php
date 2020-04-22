<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTestreq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testreqs', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('paid_at')->nullable();
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->string('unique_id')->nullable();
            $table->string('otp')->nullable();
            $table->integer('status')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testreqs', function (Blueprint $table) {
            $table->dropColumn(['status', 'completed_at', 'paid_at']);
            
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn(['status', 'unique_id', 'otp']);
        });
    }
}
