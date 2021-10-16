<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico', function (Blueprint $table) {
            $table->id();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->float('imc')->nullable();
            $table->unsignedBigInteger('aluno_id');
            $table->timestamps();

            $table->foreign('aluno_id')
            ->references('id')
            ->on('pessoa')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico');
    }
}
