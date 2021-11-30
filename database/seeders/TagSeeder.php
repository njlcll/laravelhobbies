<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sports' => 'primary text-light', // blue
            'Relaxation' => 'secondary text-light', // grey
            'Fun' => 'warning text-light', // yellow
            'Nature' => 'success text-light', // green
            'Inspiration' => 'light text-dark', // white grey
            'Friends' => 'info text-light', // turquoise
            'Love' => 'danger text-light', // red
            'Interest' => 'dark text-light' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'name' => $key,
                    'style' => $value
                ]
            );
            $tag->save();
        }

    }
}
