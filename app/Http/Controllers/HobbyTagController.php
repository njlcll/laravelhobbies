<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobby;
use App\Models\Tag;

class HobbyTagController extends Controller
{
    public function getFilteredHobbies($tagId)
    {
        $tag = new Tag();
        $hobbies = $tag::findOrFail($tagId)->filteredHobbies()->paginate(20);
        $filter = $tag::find($tagId);

        return view('hobby.index', [
            'hobbies' => $hobbies,
            'filter' => $filter
        ]);
    }

    public function attachTag($hobbyId, $tagId)
    {

       
        $hobby = Hobby::find($hobbyId);
        $tag = Tag::find($tagId);
        $hobby->tags()->attach($tagId);
        return back()->with([
            'message_success' => "The Tag <b>" . $tag->name . "</b> was added."
        ]);
    }


    public function detachTag($hobbyId, $tagId)
    {
        $hobby = Hobby::find($hobbyId);
        $tag = Tag::find($tagId);
       
        $hobby->tags()->detach($tagId);
        return back()->with(
            [
                'message_success' => "The tag <b>" . $tag->name . "</b> was removed."
            ]
        );
    }
}
