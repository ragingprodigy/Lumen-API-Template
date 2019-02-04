<?php

use Illuminate\Database\Seeder;

class CreateDefaultAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = \DevProject\Eloquent\Models\User::query()->where('username', 'admin')->count();

        if (0 === $check) {
            factory(\DevProject\Eloquent\Models\User::class)->create([
                'username' => 'admin',
                'is_admin' => true,
            ]);
        }
    }
}
