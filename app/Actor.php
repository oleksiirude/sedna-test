<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];
    
    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Movie::class, 'actor_movie', 'actor_id', 'movie_id');
    }
    
    /**
     * Search movie by actor's name.
     *
     * @param string $name
     *
     * @return Movie|null
     */
    public function searchMovieByActorName(string $name)
    {
        $actor = $this->where('first_name', 'like', "%$name%")->first();
        
        return $actor ? $actor->films[0] : null;
    }
}
