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
    
    /**
     * Disable timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * Delete format.
     *
     * @param array $params
     *
     * @return boolean
     */
    public function deleteFormat(array $params)
    {
        return (boolean) $this->where([
            'movie_id' => $params['movie_id'],
            'format' => $params['format']
        ])->delete();
    }
    
    /**
     * Create format.
     *
     * @param array $params
     *
     * @return void
     */
    public function createFormat(array $params)
    {
        $this->firstOrCreate([
            'movie_id' => $params['movie_id'],
            'format' => $params['format']
        ]);
    }
}
