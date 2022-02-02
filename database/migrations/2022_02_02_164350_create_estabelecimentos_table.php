<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->string('nome', 45);
            $table->string('tipo', 45);
            $table->string('endereco', 255)->nullable();
            $table->text('descricao');
            $table->string('logo', 255)->nullable();
            $table->string('cor_tema', 10);
            $table->string('telefone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('site', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('linkedin', 100)->nullable();
            $table->string('messenger', 100)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('youtube', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimentos');
    }
}
