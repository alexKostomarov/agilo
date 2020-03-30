<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();

            //id клиента отправившего запрос
            $table->bigInteger("user_id")->unsigned();

            //связь с таблицей пользователей
            $table->foreign("user_id")
                ->references('id')
                ->on('users')
                ->onDelete('cascade');//удалить все запросы при удалении пользователя

            //тема заявки
            $table->string('subject');

            //текст заявки
            $table->longText('message');

            //имя загруженного файла, приложенного к заявке
            $table->string('file', 255, null)->nullable();

            /*
             * false, если заявка или ее изменние не просмотрена менеджером,
             * */
            $table->boolean('is_viewed')->default(fales);

            /*
             * false, если на заявку или ее изменние не было ответа менеджера,
             * */
            $table->boolean('is_answered')->default(fales);

            //true, если заявка закрыта клиентом
            $table->boolean('is_closed')->default(fales);

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
        Schema::dropIfExists('support_requests');
    }
}
