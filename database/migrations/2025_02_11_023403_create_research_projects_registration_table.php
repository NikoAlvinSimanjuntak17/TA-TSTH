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
        Schema::create('research_projects_registration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('researcher_id')->constrained('researchers')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('research_projects')->onDelete('cascade');
            $table->string('interest')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
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
        Schema::dropIfExists('research_project_registrations');
    }
};
