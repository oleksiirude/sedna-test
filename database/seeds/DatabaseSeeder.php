<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $usersNb = 100;
    private $filmsNb = 1000;
    private $actorsNb = 5000;
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, $this->usersNb)->create();

        $films = factory(App\Film::class, $this->filmsNb)->make()->each(function ($film) {
            $film->user_id = rand(1, $this->usersNb);
        })->toArray();
        App\Film::insert($films);
    
        $actors = factory(App\Actor::class, $this->actorsNb)->make()->toArray();;
        App\Actor::insert($actors);
        
        $formats = $this->makeDataForFormatTable();
        DB::table('formats')->insert($formats);
        
        $pivotData = $this->makeDataForPivotTable();
        DB::table('actor_film')->insert($pivotData);
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
        for ($i = 1; $i <= $this->filmsNb; $i++) {
            $format['film_id'] = $i;
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
    
        $filmId = 1;
        $actorId = 1;
        while ($filmId <= $this->filmsNb) {
            $counter = 0;
            while ($counter < 5) {
                $row['actor_id'] = $actorId;
                $row['film_id'] = $filmId;
                $pivotData[] = $row;
                $actorId++;
                $counter++;
            }
            $filmId++;
        }
        return $pivotData;
    }
}
