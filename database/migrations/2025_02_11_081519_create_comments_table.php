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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blogs_id')->constrained()->onDelete('cascade'); // Relasi ke post
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User yang memberi komentar
            $table->text('comment_text');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Reply ke komentar lain
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
        Schema::dropIfExists('comments');
    }
};
