<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('store_id');
            $table->text('description');
            $table->string('code')->unique;
            $table->float('subtotal')->nullable();
            $table->float('vat')->nullable();
            $table->float('total')->nullable();
            $table->timestamp('state')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('store_id')->references('id')->on('stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
?>
