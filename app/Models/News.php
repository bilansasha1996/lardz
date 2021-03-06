<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'user_id',
    ];
    /**
     * Проставление связи с Users
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Генерация поля slug
     *
     */
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    /**
    *  удаляем опасный код
    */
    public function setContentAttribute($value){
        $this->attributes['content'] = clean($value);
    }

    /**
     * преобразуем markdown в html
     */
    public function getMarkdownContentAttribute() {
        return (new Parsedown)->text($this->attributes['content']);
    }

}
