<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('data_nasc');
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->string('cpf');
            $table->text('endereco')->nullable();
            $table->string('telefone');
            $table->text('objetivo')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('tipo');
            $table->float('imc')->nullable();
            $table->integer('ativo')->nullable()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('pessoa');
    }
}
