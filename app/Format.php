<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movie_id', 'format'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'movie_id'
    ];
    
    public $timestamps = false;
}
