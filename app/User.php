<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
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
        'password'
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * Override origin method of Illuminate/Database/Eloquent/Concerns/HasTimestamps trait.
     *
     * @param  mixed  $value
     *
     * @return void
     */
    public function setUpdatedAt($value)
    {
    }
    
    /**
     * Register new user.
     *
     * @param array $attributes (name, email, password)
     *
     * @return void
     */
    public function registerNewUser(array $attributes)
    {
        $this->name = strtolower($attributes['name']);
        $this->email = $attributes['email'];
        $this->password = bcrypt($attributes['password']);
        $this->save();
    }
    
    /**
     * Instantiate a new HasMany relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function films()
    {
        return $this->hasMany(Film::class);
    }
}
