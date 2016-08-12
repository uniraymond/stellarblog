<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<= 11; $i++) {
            DB::table('blogs')->insert([
                'title' => $i .' Titile ' . str_random(5),
                'body' => '<h1>The ' . $i .' Blog</h1> <br /><br /><p>The Laravel framework has a few system requirements.
                 Of course, all of these requirements are satisfied by the Laravel Homestead virtual machine, 
                 so it\'s highly recommended that you use Homestead as your local Laravel development environment.
                 <br /><br />
                 However, if you are not using Homestead, you will need to make sure your server meets the following requirements:</p>',
                'active' => 1,
                'user_id' => 1
            ]);

        }
    }
}
