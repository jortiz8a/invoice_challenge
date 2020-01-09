<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->text('name');
            $table->text('last_name');
            $table->text('id_type');
            $table->integer('id_number')->unique;
            $table->string('email')->unique;
            $table->string('address');
            $table->bigInteger('phone');
            $table->text('country');
            $table->text('city');
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
        Schema::dropIfExists('clients');
    }
}
?>
