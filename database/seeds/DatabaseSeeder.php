<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

		DB::table('users')->insert([
            'name' => 'Ivan',
			'username' => 'imorales',
            'email' => 'ivan@admin.com',
            'password' => bcrypt('password'),
			'avatar' => 'https://lorempixel.com/300/300/people/?1'
        ]);

		DB::table('users')->insert([
            'name' => 'Jairo',
			'username' => 'jairolaupa',
            'email' => 'jairo@group-celit.com',
            'password' => bcrypt('password'),
			'avatar' => 'https://lorempixel.com/300/300/people/?2'
        ]);

		factory(App\User::class)
			->times(18)
			->create();

		factory(App\Photo::class)
			->times(150)
			->create();

		// Le doy una cantidad random de seguidores a cada uno de los usuarios
		$users = User::all();

		$users->each(function(App\User $user) use ($users) {
			$cant = random_int(0, 12);

			$user->following()->sync(
				$users->random($cant)
			);
		});


		// Otra forma de hacer seeding, pero no me gusta porque para cada usuario crea la misma cantidad de fotos
		//
		// factory(App\User::class, 10)->create()->each(function (App\User $user) {
		// 	factory(App\Photo::class)
		// 		->times(16)
		// 		->create([
		// 			'user_id' => $user->id // Aca cuidado porque mi create ya produce un user_id al azar de los dispoibles (kind of)
		// 		]);
		// });
    }
}
