<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Package is a Subject(s) + Price
 * It acts like product
 * 
 * The Idea is, its possible when price of a subject is different between older student and new student
 */
class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);             // name or code
            $table->string('description', 255);
            $table->string('status');           // active
            $table->date('start_date');         // when the package is active
            $table->double('price');            // price of the
            $table->double('fee_per_hour');     // fee to lecturer per hour for subject(s) of this package
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
