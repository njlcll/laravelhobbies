<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{

    // php artisan make:middleware AdminMiddleware
    // adminmiddleware function add rule
    // controller add middleware
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware('admin')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index')->with(
            ['tags' => $tags]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'style' => 'required|min:5'
        ]);
        $style = new Tag(
            [
                'name' => $request->name,
                'style' => $request['style']
            ]
        );
        $style->save();
        return $this->index()->with(
            [
                'message_success' => "The style <b>" . $style->name . "</b> was created."
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        abort_unless(Gate::allows('update', $tag), 403);
        return view('tag.edit')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        abort_unless(Gate::allows('update', $tag), 403);
        $request->validate([
            'name' => 'required|min:3',
            'style' => 'required|min:5'
        ]);
        $tag->update([
            'name' => $request['name'],
            'style' => $request['style'],
        ]);

        return $this->index()->with(
            [
                'message_success' => "The tag <b>" . $tag->name . "</b> was updated."
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        abort_unless(Gate::allows('delete', $tag), 403);
        $oldName = $tag->name;
        $tag->delete();
        return $this->index()->with(
            [
                'message_success' => "The tag <b>" . $oldName . "</b> was deleted."
            ]
        );
    }

    
}
