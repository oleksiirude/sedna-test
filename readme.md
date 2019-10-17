# Test task for SEDNA.software

## Server-side app for storing and viewing film data (REST API)

### Technologies used:
<pre>
- PHP 7.3.2
- Laravel 6.0
- MySQL 8.0.15
</pre>

#### To launch app you should:
<pre>
- clone this repo;
- install composer (globally);
- rename .env.example to .env and fill data about your DB into it;
- create database "sednatestdb" on your MySQL server;
- launch next commands from the root of project in terminal:
    1. php composer update;
    2. php artisan migrate:fresh;
    3. php artisan db:seed;
    4. php arisan jwt:secret
If you are using OSX or other UNIX-like OS just launch bash script "start.sh" 
</pre>

### Endpoints usage:
All endponints except login, register and GET methods require header "Authorization" "Bearer [JWT Token]"

#### POST /login
<pre>
info: login user, returns new JWT Token
request body: email, password
</pre>

#### POST /register
<pre>
info: register user
request body: login, email, password, password_confirm
</pre>

#### GET /movies
<pre>
info: show number of movies and short data about each
query string: none
</pre>

#### GET /movies/search
<pre>
info: search movie by its title or actor's name
query string: by (name or title), query
</pre>

#### GET /movies/{movieId}
<pre>
info: show full movie data
query string: none
</pre>

#### POST /movies
<pre>
info: create new movie
request body: title, summary, prod_year
</pre>

#### PATCH /movies/title
<pre>
info: change movie title
request body: movie_id, title
</pre>

#### PATCH /movies/summary
<pre>
info: change movie summary
request body: movie_id, summary
</pre>

#### PATCH /movies/prod_year
<pre>
info: change movie production year
request body: movie_id, prod_year
</pre>

#### DELETE /movies
<pre>
info: delete movie
request body: movie_id
</pre>

#### POST /actors
<pre>
info: create new actor
request body: movie_id, first_name, last_name
</pre>

#### DELETE /actors
<pre>
info: delete actor
request body: movie_id, actor_id
</pre>

#### POST /formats
<pre>
info: create new format for movie
request body: movie_id, format (VHS, Blu-Ray, DVD)
</pre>

#### DELETE /formats
<pre>
info: delete format
request body: movie_id, format (VHS, Blu-Ray, DVD)
</pre>

#### POST /logout
<pre>
info: logout user (invalidate JWT Token)
request body: none
</pre>

#### *
<pre>
Only content's creator and authenticated user can delete or change data
</pre>

Enjoy :)

