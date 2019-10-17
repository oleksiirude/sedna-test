# Test task for SEDNA.software

## API - server-side app for storing and viewing film data

### Technologies used:
<pre>
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

Enjoy :)
</pre>
