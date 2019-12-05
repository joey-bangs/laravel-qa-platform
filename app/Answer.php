<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'votes_count', 'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function (Answer $answer) {
            $answer->question()->increment('answers_count');
        });
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
