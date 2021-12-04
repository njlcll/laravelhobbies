<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Tag;
use App\Http\Requests\StoreHobbyRequest;
use App\Http\Requests\UpdateHobbyRequest;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // $hobbies = Hobby::all();

        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(20);
        return view('hobby.index')->with(
            ['hobbies' => $hobbies]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHobbyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHobbyRequest $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);


        $hobby = new Hobby(
            [
                'name' => $request->name,
                'description' => $request['description'],
                'user_id' => auth()->id()
            ]
        );

        if ($request->image) {
            $this->saveImages($request->image, $hobby->id);
        }


        $hobby->save();
        return redirect('/hobby/' . $hobby->id)->with(
            [
                'message_warning' => "Please assign some tags now."
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {

        $allTags = Tag::all();
        $usedTags = $hobby->tags;
        $availableTags = $allTags->diff($usedTags);

        return view('hobby.show')->with([
            'hobby' => $hobby,
            'availableTags' => $availableTags,
            'message_success' => Session::get(''),
            'message_warning' => "Please assign some tags now."
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        abort_unless(Gate::allows('update', $hobby), 403);
        return view('hobby.edit')->with([
            'hobby' => $hobby,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHobbyRequest  $request
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHobbyRequest $request, Hobby $hobby)
    {
        abort_unless(Gate::allows('update', $hobby), 403);
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if ($request->image) {
            $this->saveImages($request->image, $hobby->id);
        }

        $hobby->update([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);

        return $this->index()->with(
            [
                'message_success' => "The hobby <b>" . $hobby->name . "</b> was updated."
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        abort_unless(Gate::allows('delete', $hobby), 403);

        $oldName = $hobby->name;
        $hobby->delete();

        return $this->index()->with(
            [
                'message_success' => "The hobby <b>" . $oldName . "</b> was deleted."
            ]
        );
    }

    public function saveImages($imageInput, $hobby_id)
    {
        $image = Image::make($imageInput);
        if ($image->width() > $image->height()) { // Landscape
            $image->widen(1200)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg")
                ->widen(400)->pixelate(12)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->widen(60)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg");
        } else { // Portrait
            $image->heighten(900)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg")
                ->heighten(400)->pixelate(12)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->heighten(60)
                ->save(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg");
        }
    }

    public function deleteImages($hobby_id)
    {
        if (file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg");
        if (file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg");
        if (file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg");

        return back()->with(
            [
                'message_success' => "The Image was deleted."
            ]
        );
    }
}
