<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'answers';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','support_request_id', 'answer'
    ];

    /**
     * Получить ответившекго клиента.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Получить заявку к которой относится ответ
     */
    public function support_request()
    {
        return $this->belongsTo('App\SupportRequest');
    }

}
