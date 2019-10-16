<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'prod_year', 'user_id'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];
    
    /**
     * Disable time stamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_movie', 'movie_id', 'actor_id');
    }
    
    /**
     * Instantiate a new HasMany relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formats()
    {
        return $this->hasMany(Format::class);
    }
    
    /**
     * Get movie by id.
     *
     * @param int $movieId
     *
     * @return self
     */
    public function getMovie($movieId)
    {
        return self::findOrFail($movieId);
    }
    
    /**
     * Get all of the models from the database.
     *
     * @return Collection
     */
    public function getAllMovies()
    {
        return self::all('id', 'title');
    }
    
    /**
     * Search movie by title.
     *
     * @param string $title
     *
     * @return Movie|null
     */
    public function searchMovieByTitle(string $title)
    {
        $movie = $this->where('title', 'like', "%$title%")->first();
        
        return $movie ? $movie : null;
    }
    
    public function getMovieOwnerId($movieId)
    {
        $movie = $this->where('id', '=', $movieId)->first();
        $movie->makeVisible('user_id');
        
        return $movie->user_id;
    }
}
