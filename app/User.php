<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUrlAttribute(): string
    {
        return '#';
    }

    public function getAvatarAttribute(): string
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function favourites()
    {
        return $this->belongsToMany('App\Question', 'favourites')->withTimestamps();
    }

    public function voteQuestion(Question $question, int $vote)
    {
        $voteQuestion = $this->voteQuestions();

        if ($voteQuestion->where('votable_id', $question->id)->exists()) {
            $voteQuestion->updateExistingPivot($question, ['vote' => $vote]);
        } else {
            $voteQuestion->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');

        $question->update([
            'votes_count' => (int)$question->votes()->pluck('vote')->sum()
        ]);
    }

    public function voteQuestions()
    {
        return $this->morphedByMany('App\Question', 'votable')->withTimestamps();
    }

    public function voteAnswer(Answer $answer, int $vote)
    {
        $voteAnswer = $this->voteAnswers();

        if ($voteAnswer->where('votable_id', $answer->id)->exists()) {
            $voteAnswer->updateExistingPivot($answer, ['vote' => $vote]);
        } else {
            $voteAnswer->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votes');

        $answer->update([
            'votes_count' => (int)$answer->votes()->pluck('vote')->sum()
        ]);
    }

    public function voteAnswers()
    {
        return $this->morphedByMany('App\Answer', 'votable')->withTimestamps();
    }
}
