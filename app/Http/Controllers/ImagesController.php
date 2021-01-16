<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display the Images Page and Send data to be filled into the table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('images.index')->with('images', Image::all()); 
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
        // Validation for all fields being received from the view via model
        $this->validate($request, [
            'title' => 'required|min:6|unique:images,title',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg',
            'size' => 'required',
            'permission' => 'required|numeric'
        ]);

        // store image in public/images
        $image = $request->image->store('public/images');

        // store input request into the databasse after validation is true
        Image::create([
            'title' => $request->title,
            'price' => $request->price,
            'discount' => $request->discount,
            'image_file' => $image,
            'size' => $request->size,
            'permission' => $request->permission //permission 0 - public 1-private
        ]);
        return redirect(Route('user_images.index'))->with('success', 'Image Upload Accepted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        return redirect(Route('user_images.index')); //redirect to image dash route
    }
}
