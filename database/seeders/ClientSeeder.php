<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
        for($i=0; $i<10; $i++)
        {  
                $data = new Client();
                $data->name = $faker->name;
                $data->email = $faker->email;
                $data->phone = $faker->numerify('##########');
                $data->password = Hash::make('12345678');
                $data->status = 'unblock';
                $data->save();
        }

    }

}
