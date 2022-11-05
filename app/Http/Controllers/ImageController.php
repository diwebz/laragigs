<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload(Image $image)
    {
        return view('image.imageUploads', [
            'image' => $image
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();  
                $image->move(public_path('images/external'), $imageName);
  
                $images[]['image_name'] = $imageName;
            }
        }
  
        foreach ($images as $key => $image) {
            Image::create($image);
        }
      
        return back()
                ->with('success','You have successfully uploaded image.')
                ->with('images', $images); 
    }
}
