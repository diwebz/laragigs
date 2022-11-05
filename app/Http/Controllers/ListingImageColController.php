<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Images_col;
use App\Models\images_cols;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ListingImageColController extends Controller
{
    //Show all listings
    public function index_imagecol() {
        // dd(request('tag')); //this just for debugging
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2)); //debug pagination
        return view('listings.index_imagecol', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single listing
    public function show_imagecol(Listing $listing) {

        // $listing = Listing::with('images_col')->where('listing_id', $listing->id);

        return view('listings.show_imagecol', ['listing' => $listing]);

        

        // Image::where('listing_id', $listing->id);
        // $images = $listing->images;
        
        // return view('listings.show', 
        //     compact(['listing' => $listing,
        //     'listing','images'])
        // );
    }

    //Show images for listings
    public function images($id) {
        $listing = Listing::find($id);
        if(!$listing) abort(404);
        $images = $listing->images;
        return view('image.images',compact('listing','images'));
    }

    //Show create form
    public function create_imagecol() {
        return view('listings.create_imagecol');
    }

    //Store create form
    public function store_imagecol(Request $request) {
        // dd($request->all());
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);


        //validate uploaded images
        $validator = Validator::make($request->all(), [
            'img_one' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_two' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_three' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_four' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_five' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_six' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_seven' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_eight' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_nine' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_ten' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'mimes' => 'allowed file types are jpeg,png,jpg,gif,svg only.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //Add user_id same as logged in user's id when create listing
        $formFields['user_id'] = auth()->id();

        //Here is the class inserting newly created item into DB
        $new_listing = Listing::create($formFields);

        // if($request->has('images')){
        //     foreach($request->file('images')as $image){
        //         $imageName = $formFields['title'].'-image-'.time().rand(1,1000).'.'.$image->extension();
        //         $image->move(public_path('images/external'),$imageName);
        //         Images_col::create([
        //             'listing_id'=>$new_listing->id,
        //             'image_name'=>$imageName
        //         ]);
        //     }
        // }

        Images_cols::create(['listing_id'=>$new_listing->id]);
        
        // $request->validate([
        //     'listing_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $listing_images = collect([
            'img_one',
            'img_two',
            'img_three',
            'img_four',
            'img_five',
            'img_six',
            'img_seven',
            'img_eight',
            'img_nine',
            'img_ten'
            ]);

        foreach($listing_images as $image) {

            if ($request->hasFile($image)) {

                $file = $request->$image;

                $name = $formFields['title'].'-image-'.time().rand(1,1000).'.'.$file->extension();

                $file->move(public_path('images/external/'),$name);

                // $new_listing->$image = $name; //I think this line is unnecessary

                // Images_col::save([
                //     'listing_id'=>$new_listing->id,
                //     $image => $name
                // ]);
        
                Images_cols::where('listing_id', $new_listing->id)->update([
                        $image => $name
                    ]);

                // $listing_images[$image] = $file->$name;

                //debug all items with image array
                //dd(request()->all());

            }
        }

        //redirect to listings page after created new listing, with a flash message.
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    

    //Show edit form
    public function edit_imagecol(Listing $listing) {
        // dd($listing->title);
        return view('listings.edit_imagecol', ['listing' => $listing]);
    }

    //Update listing data
    public function update_imagecol(Request $request, Listing $listing) {

        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // if($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        //Instead of using static method we should use reqular method
        $listing->update($formFields);

        $listingImage = Images_cols::findOrFail($listing->id);

        // $imageID = Images_cols::where('listing_id', $listingImage->id);

        $listing_images =  collect([
            'img_one',
            'img_two',
            'img_three',
            'img_four',
            'img_five',
            'img_six',
            'img_seven',
            'img_eight',
            'img_nine',
            'img_ten']);

        foreach($listing_images as $image) {


            if ($request->hasFile($image)) {

                $file = $request->$image;

                $name = $formFields['title'].'-image-'.time().rand(1,1000).'.'.$file->extension();

                $file->move(public_path('images/external/'),$name);

                // $new_listing->$image = $name; //I think this line is unnecessary

                // Images_col::save([
                //     'listing_id'=>$new_listing->id,
                //     $image => $name
                // ]);
                
                // dd($image);

                // $getOldName = $image->getClientOriginalName();

                $getExistingName = ($listing->images_col[0]->$image);

                $imagePath = public_path('images/external/').$getExistingName;
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                // dd($imagePath);
                

                Images_cols::where('listing_id', $listingImage->id)->update([
                    $image => $name
                ]);

                // $listing_images[$image] = $file->$name;

                // dd($image);

                //debug all items with image array
                //dd(request()->all());

            }
        }

        //redirect to listings page after updated listing, with a flash message.
        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete listing
    public function destroy_imagecol(Listing $listing) {
        
        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing_images = collect(['img_one', 'img_two', 'img_three', 'img_four', 'img_five', 'img_six', 'img_seven', 'img_eight', 'img_nine', 'img_ten']);


        //Delete images from drive (multiple rows)
        if (!$listing->images_col->isEmpty()) {

        foreach($listing_images as $image) {
                // unlink(public_path('images/external/').$image->image_name);
                // File::delete(public_path('images/external/').$image->image_name); //this also works
            
                $getExistingName = ($listing->images_col[0]->$image);

                File::delete(public_path('images/external/').$getExistingName);
                // dd($getExistingName);
            
            }
        }

        // dd($listing->images);

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    //Manage listing
    public function manage_imagecol() {
        return view('listings/manage_imagecol', ['listings' => auth()->user()->listings()->get()]);
    }
}
