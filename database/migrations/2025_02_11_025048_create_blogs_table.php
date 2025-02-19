<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penulis/Admin
            $table->string('title');
            $table->text('content');
            $table->string('image'); // Path gambar
            $table->unsignedBigInteger('category_id'); // Relasi ke blog_categories
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->date('published_at'); // Tanggal posting
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
        Schema::dropIfExists('research_blogspot');
    }
};
