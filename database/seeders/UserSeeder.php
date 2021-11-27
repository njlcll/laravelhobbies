<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //\App\Models\User::factory(App\Models\User::class, 10)->create();
        \App\Models\User::factory(30)->create()
        ->each(function ($user){
            \App\Models\Hobby::factory(rand(1,5))->create([
                'user_id' => $user->id
            ]);
        })
        ->each(function ($hobby){
            $tag_ids = range(1,8);
            shuffle($tag_ids );
            $assignments = array_slice($tag_ids, 0 ,rand(0,8));
            foreach($assignments as $tag_id){
                DB::table('hobby_tag')
                ->insert([
                    'hobby_id' =>$hobby->id,
                    'tag_id' => $tag_id,
                    'created_at' =>now(),
                    'updated_at' =>now(),
                ]);
            }
        }) ;
        
      
    }
}
