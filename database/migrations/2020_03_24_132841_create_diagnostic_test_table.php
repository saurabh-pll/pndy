<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_centre_test', function (Blueprint $table) {
            $table->unsignedBigInteger('diagnostic_centre_id');
            $table->unsignedBigInteger('test_id');
            $table->decimal('price',8,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnostic_centre_test', function (Blueprint $table) {
            Schema::dropIfExists('diagnostic_centre_test');
        });
    }
}
