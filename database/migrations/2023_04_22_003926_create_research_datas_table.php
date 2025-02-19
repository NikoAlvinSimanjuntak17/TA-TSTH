<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_datas', function (Blueprint $table) {
            $table->id();
            $table->string('research_title');
            $table->text('abstract');
            $table->integer('price');
            $table->string('research_category_name');
            $table->unsignedBigInteger('research_category_id');
            $table->foreign('research_category_id')->references('id')->on('categories');
            $table->string('researcher_name');
            $table->unsignedBigInteger('researcher_id');
            $table->foreign('researcher_id')->references('id')->on('researchers');
            $table->integer('year');
            $table->string('doi')->unique()->nullable();
            $table->text('file_path');
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
        Schema::dropIfExists('products');
    }
};
