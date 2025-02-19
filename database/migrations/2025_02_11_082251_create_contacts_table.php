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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('address'); // Alamat kantor
            $table->string('email'); // Email kontak
            $table->string('phone')->nullable(); // Nomor telepon
            $table->string('working_hours'); // Jam operasional
            $table->string('twitter')->nullable(); // Link Twitter
            $table->string('facebook')->nullable(); // Link Facebook
            $table->string('pinterest')->nullable(); // Link Pinterest
            $table->string('instagram')->nullable(); // Link Instagram
            $table->unsignedBigInteger('created_by')->nullable(); // User yang membuat
            $table->unsignedBigInteger('updated_by')->nullable(); // User yang mengupdate
            $table->timestamps();
            

            // Foreign key ke tabel users
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
