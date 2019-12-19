<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('destinatario_id');
            $table->unsignedBigInteger('remetente_id');
            $table->tinyInteger('lido')->default(0);
            $table->longText('mensagem');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('destinatario_id', 'user_destinatario_foreign_key')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('remetente_id', 'user_remetente_foreign_key')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('mensagens');
        $table->dropForeign('user_destinatario_foreign_key');
        $table->dropForeign('user_remetente_foreign_key');
    }
}
