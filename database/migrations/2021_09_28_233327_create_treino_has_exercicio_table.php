<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreinoHasExercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treino_has_exercicio', function (Blueprint $table) {
            $table->id();
            $table->integer('repeticoes');
            $table->integer('series');
            $table->integer('sequencia');
            $table->unsignedBigInteger('treino_id');
            $table->unsignedBigInteger('exercicio_id');
            $table->timestamps();

            $table->foreign('treino_id')
                    ->references('id')
                    ->on('treino');
            
            $table->foreign('exercicio_id')
                    ->references('id')
                    ->on('exercicio');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treino_has_exercicio');
    }
}
