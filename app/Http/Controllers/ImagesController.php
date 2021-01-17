<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteRequest;
use App\Http\Requests\StoreRequest;
use App\Image;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImagesController extends Controller
{
    /**
     * Display the Images Page and Send data to be filled into the table.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $user_id = Auth::user()->id;
        return view('images.index')->
        with('images', Image::where('user_id', $user_id)->get()); 
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
    public function store(StoreRequest $request)
    {

        // store image in public/images
        $image = $request->image->store('public/images');

        // store input request into the databasse after validation is true
        Image::create([
            'title' => $request->title,
            'price' => $request->price,
            'discount' => $request->discount,
            'image_file' => $image,
            'size' => $request->size,
            'user_id' => Auth::user()->id,
            'permission' => $request->permission //permission 0 - public 1-private
        ]);
        return redirect(Route('user_images.index'))->with('success', 'Image Upload Accepted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //using route model binding
    {
        Image::find($id)->delete(); //invoke delete function
        return redirect(Route('user_images.index'))->with('success', 'Image Deleted'); //redirect to image dash route
    }

    // Delete Multiple Images
    public function destroy_multiple(DeleteRequest $request) //using route model binding
    {
        
        $image_ids = $request->image_id;

            foreach($image_ids as $id){
                Image::find($id)->delete();
            }
        return redirect(Route('user_images.index'))->with('success', 'Selection Deleted'); //redirect to image dash route
    }

    /* Delete All User Related images

    ** */
    public function destroy_all()
    {
        Image::where('user_id', Auth::user()->id)->delete();
        session()->flash('success', 'Deleted!');
        return redirect(Route('user_images.index'))->with('success', 'Selection Deleted'); //redirect to image dash route
    }
}
