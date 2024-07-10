<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();
        foreach ($films as $film) {
            if ($film->actors()->exists()) { // Verifica se il film ha già attori associati
                continue; // Passa al prossimo film
            }
            $numActors = rand(2, 5); //genera un numero casuale!
            // Scegliamo casualmente alcuni attori
            $selectedActors = $actors->random($numActors);
            // Associa il film agli attori selezionati
            foreach ($selectedActors as $actor) {
                $film->actors()->attach($actor->id, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
