<?php

namespace App\Http\Controllers;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       

        return view('user.show')->with([
            'user' => $user,
         
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with([            
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      
        $request->validate([
          
            
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);
    

        if ($request->image) {
            $this->saveImages($request->image, $user->id);
        }

        $user->update([
            'motto' => $request['motto'],
            'about_me' => $request['about_me'],
        ]);

        return redirect('/home')->with(
            [
                'message_success' => "Your user profile was updated."
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    
    public function saveImages($imageInput, $user_id)
    {
        $image = Image::make($imageInput);
        if ($image->width() > $image->height()) { // Landscape
            $image->widen(1200)
                ->save(public_path() . "/img/users/" . $user_id . "_large.jpg")
                ->widen(400)->pixelate(12)
                ->save(public_path() . "/img/hobbies/" . $user_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->widen(60)
                ->save(public_path() . "/img/users/" . $user_id . "_thumb.jpg");
        } else { // Portrait
            $image->heighten(900)
                ->save(public_path() . "/img/users/" . $user_id . "_large.jpg")
                ->heighten(400)->pixelate(12)
                ->save(public_path() . "/img/users/" . $user_id . "_pixelated.jpg");
            $image = Image::make($imageInput);
            $image->heighten(60)
                ->save(public_path() . "/img/users/" . $user_id . "_thumb.jpg");
        }
    }

    public function deleteImages($user_id)
    {
        if (file_exists(public_path() . "/img/users/" . $user_id . "_large.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_large.jpg");
        if (file_exists(public_path() . "/img/users/" . $user_id . "_thumb.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_thumb.jpg");
        if (file_exists(public_path() . "/img/users/" . $user_id . "_pixelated.jpg"))
            unlink(public_path() . "/img/users/" . $user_id . "_pixelated.jpg");

        return back()->with(
            [
                'message_success' => "The Image was deleted."
            ]
        );
    }
}
