<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SupportRequest extends Model
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'support_requests';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','subject', 'message'
    ];

    /**
     * Получить клиента, которму принадлежит заявка.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Получить все отвтеты на эту заявку
     */
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

}
