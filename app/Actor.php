<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];
    
    /**
     * Disable timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    
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
    
    /**
     * Create actor.
     *
     * @param array $params
     *
     * @return boolean
     */
    public function createActor(array $params)
    {
        if ($this->checkIfExists($params))
            return false;
        
        $result = $this->create([
            'first_name' => $params['first_name'],
            'last_name' => $params['last_name'],
        ]);
     
        $actor = $this::find($result->id);
        $actor->films()->attach($params['movie_id']);
        return true;
    }
    
    /**
     * Check if already exists in movie.
     *
     * @param array $params
     *
     * @return boolean
     */
    private function checkIfExists(array $params)
    {
        $movie = (new Movie())->find($params['movie_id']);
        
        foreach ($movie->actors as $actor) {
            if ($actor->first_name === $params['first_name']
            && $actor->last_name === $params['last_name'])
                return true;
        }
        
        return false;
    }
    
    /**
     * Delete actor from pivot table.
     *
     * @param array $params
     *
     * @return boolean
     */
    public function deleteActorFromPivotTable(array $params)
    {
        $actor = $this::find($params['actor_id']);
        if (!$actor)
            return false;
        
        $actor->films()->detach($params['movie_id']);
        return true;
    }
    
    /**
     * Check if actor present in movies.
     *
     * @param int $actorId
     *
     * @return void
     */
    public function checkIfPresentInMovies(int $actorId)
    {
        $present = DB::table('actor_movie')
            ->where('actor_id', '=', $actorId)
            ->count();
        
        if (!$present)
            $this->deleteActor($actorId);
    }
    
    /**
     * Delete actor from actors table.
     *
     * @param int $actorId
     *
     * @return void
     */
    private function deleteActor($actorId)
    {
        $this->destroy($actorId);
    }
}
