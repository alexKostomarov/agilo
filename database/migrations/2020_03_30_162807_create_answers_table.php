<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            //id клиента отправившего ответ
            $table->bigInteger("user_id")->unsigned();

            //связь с таблицей пользователей
            $table->foreign("user_id")
                ->references('id')
                ->on('users')
                ->onDelete('cascade');//удалить все ответы при удалении пользователя

            //id заявки на которую дан ответ
            $table->bigInteger("support_request_id")->unsigned();

            //связь с таблицей заявок
            $table->foreign("support_request_id")
                ->references('id')
                ->on('support_requests')
                ->onDelete('cascade');//удалить все ответы при удалении заявки

            //текст ответа
            $table->longText('answer');

            $table->timestamps();

            //прямая ссылка на заявку
            $table->char(255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
