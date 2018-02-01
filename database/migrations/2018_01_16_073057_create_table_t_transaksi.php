<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->datetime('date_transaction')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('payment_date')->nullable();
            $table->string('source',50)->nullable();
            $table->string('rincian',150)->nullable();
            $table->enum('type', ['paid', 'unpaid'])->default('unpaid');
            $table->text('deskripsi')->nullable();
            $table->integer('grand_total');
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
        Schema::dropIfExists('t_transaksi');
    }
}
