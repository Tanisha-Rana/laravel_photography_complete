<?php

namespace Database\Seeders;

use App\Models\Photographer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class photographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        for($i=0; $i<10; $i++)
        {  
                $data = new Photographer();
                $data->name = $faker->name;
                $data->email = $faker->email;
                $data->password = Hash::make('12345678');
                $data->phone = $faker->numerify('##########');
                $data->status = 'active';
                $data->save();
        }

    }
}
