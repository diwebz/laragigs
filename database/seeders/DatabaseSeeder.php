<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //listings dummy data
        // Listing::factory(6)->create();


        // Listing::create([
        //     'title' => 'Laravel senior developer',
        //     'tags' => 'laravel, javascript, html',
        //     'company' => 'acme.corp',
        //     'location' => 'Tokyo',
        //     'email' => 'acme@aaa.com',
        //     'website' => 'acme.com',
        //     'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        //     Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown 
        //     printer took a galley of type and scrambled it to make a type specimen book.'
        // ]);

        // Listing::create([
        //     'title' => 'Laravel junior developer',
        //     'tags' => 'back-end, vue, css',
        //     'company' => 'stark.corp',
        //     'location' => 'Yokohama',
        //     'email' => 'stark@aaa.com',
        //     'website' => 'stark.com',
        //     'description' => '111Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        //     Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown 
        //     printer took a galley of type and scrambled it to make a type specimen book.'
        // ]);


        //final seed in development with user_id
        // $user = User::factory()->create([
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@gmail.com'
        // ]);

        // Listing::factory(5)->create([
        //     'user_id' => $user->id
        // ]);
    }
}
