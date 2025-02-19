<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('research_datas_id');
            $table->text('research_title');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nama',255);
            $table->text('shipping_phonenumber');
            $table->text('shipping_postalcode');
            $table->text('address');
            $table->text('shipping_city');
            $table->text('file_path');
            $table->text('totalprice');
            $table->string('status', 255)->default('pending');
            $table->string('transaction_status')->nullable();
            $table->text('ulasan')->nullable();
            $table->string('snap_token');
            $table->dateTime('time')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('orders');
    }
};