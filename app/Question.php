<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];

    /**
     * Sets title attribute
     *
     * This also sets the slug attribute
     *
     * @param string $value Title value
     * @return void
     **/
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
