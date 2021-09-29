<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotina', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsavel_id');
            $table->unsignedBigInteger('aluno_id');
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->foreign('responsavel_id')
                ->references('id')
                ->on('pessoa')
                ->onDelete('cascade');

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
        Schema::dropIfExists('rotina');
    }
}
