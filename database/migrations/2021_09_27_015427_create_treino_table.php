<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treino', function (Blueprint $table) {
            $table->id();
            $table->char('dia');
            $table->string('foco');
            $table->unsignedBigInteger('rotina_id');
            $table->timestamps();

            $table->foreign('rotina_id')
                    ->references('id')
                    ->on('rotina')
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
        Schema::dropIfExists('treino');
    }
}
