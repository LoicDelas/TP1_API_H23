<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Critic;
use App\Models\Role;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActorSeeder::class,
            LanguageSeeder::class,
            FilmSeeder::class,
            ActorFilmSeeder::class
        ]);

        $roleAdmin = Role::create(['name' => 'admin']);
        User::factory(3)
            ->state(new Sequence(
                ['email' => 'admin1@gmail.com'],
                ['email' => 'admin2@gmail.com'],
                ['email' => 'admin3@gmail.com']
                ))
            ->create([
                'role_id' => $roleAdmin->id
            ]);

        Role::create(['name' => 'membre']);
        User::factory(200)->has(Critic::factory(5))
            ->create();

        $userIDCritiquesDoubles = DB::table('critics')
            ->select('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(DISTINCT film_id) < 5')
            ->get();

        Critic::whereIn('user_id', $userIDCritiquesDoubles->pluck('user_id'))->delete();
    }
}
