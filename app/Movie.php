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
        'title', 'summary', 'prod_year', 'user_id'
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
     * @return Movie
     */
    public function getMovie(int $movieId)
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
    
    /**
     * Get movie owner id.
     *
     * @param int $movieId
     *
     * @return int
     */
    public function getMovieOwnerId(int $movieId)
    {
        $movie = $this->where('id', '=', $movieId)->first();
        
        return $movie ? $movie->user_id : null;
    }
    
    /**
     * Create new movie.
     *
     * @param array $params
     * @param int $userId
     *
     * @return void
     */
    public function createNewMovie(array $params, int $userId)
    {
        $this->create([
            'title' => $params['title'],
            'summary' => $params['summary'],
            'prod_year' => $params['prod_year'],
            'user_id' => $userId
        ]);
    }
    
    /**
     * Delete movie.
     *
     * @param int $movieId
     *
     * @return void
     */
    public function deleteMovie(int $movieId)
    {
        $this->where('id', '=', $movieId)->delete();
    }
    
    /**
     * Check if movie already exists.
     *
     * @param array $params
     *
     * @return boolean
     */
    public function checkIfExists(array $params)
    {
        return (boolean) $this->where([
            'title' => $params['title'],
            'summary' => $params['summary'],
            'prod_year' => $params['prod_year'],
        ])->first();
    }
    
    /**
     * Change movie's title.
     *
     * @param array $params
     *
     * @return void
     */
    public function changeTitle(array $params)
    {
        $this->where([
            'id' => $params['movie_id']
        ])->update([
            'title' => $params['title']
        ]);
    }
    
    /**
     * Change movie's summary.
     *
     * @param array $params
     *
     * @return void
     */
    public function changeSummary(array $params)
    {
        $this->where([
            'id' => $params['movie_id']
        ])->update([
            'summary' => $params['summary']
        ]);
    }
    
    /**
     * Change movie's production year.
     *
     * @param array $params
     *
     * @return void
     */
    public function changeProductionYear(array $params)
    {
        $this->where([
            'id' => $params['movie_id']
        ])->update([
            'prod_year' => $params['prod_year']
        ]);
    }
}
