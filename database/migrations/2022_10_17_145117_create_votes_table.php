<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidat_id'); // Utilisation de unsignedBigInteger pour la clé étrangère
            $table->unsignedBigInteger('user_id');
            $table->foreign('candidat_id')->references('id')->on('candidats');
            $table->foreign('user_id')->references('id')->on('students');
            $table->timestamps();
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
