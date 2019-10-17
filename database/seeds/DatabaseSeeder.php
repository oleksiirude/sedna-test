<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $usersNb = 100;
    private $moviesNb = 1000;
    private $actorsNb = 5000;
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, $this->usersNb)->create();

        $movies = factory(App\Movie::class, $this->moviesNb)->make()->each(function ($movie) {
            $movie->user_id = rand(1, $this->usersNb);
        })->toArray();
        App\Movie::insert($movies);
    
        $actors = factory(App\Actor::class, $this->actorsNb)->make()->toArray();
        App\Actor::insert($actors);
        
        $formats = $this->makeDataForFormatTable();
        DB::table('formats')->insert($formats);
        
        $pivotData = $this->makeDataForPivotTable();
        DB::table('actor_movie')->insert($pivotData);
    }
    
    /**
     * Get data for format table.
     *
     * @return array
     */
    private function makeDataForFormatTable()
    {
        $types = ['VHS', 'DVD', 'Blu-Ray'];
        
        $formats = [];
        for ($i = 1; $i <= $this->moviesNb; $i++) {
            $format['movie_id'] = $i;
            $format['format'] = $types[array_rand($types)];
            $formats[] = $format;
        }
        return $formats;
    }
    
    /**
     * Get data for pivot table.
     *
     * @return array
     */
    private function makeDataForPivotTable()
    {
        $pivotData = [];
    
        $movieId = 1;
        $actorId = 1;
        while ($movieId <= $this->moviesNb) {
            $counter = 0;
            while ($counter < 5) {
                $row['actor_id'] = $actorId;
                $row['movie_id'] = $movieId;
                $pivotData[] = $row;
                $actorId++;
                $counter++;
            }
            $movieId++;
        }
        return $pivotData;
    }
}
