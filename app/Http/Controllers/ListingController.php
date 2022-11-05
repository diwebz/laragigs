<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    //Show all listings
    public function index() {
        // dd(request('tag')); //this just for debugging
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2)); //debug pagination
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing]
        );

        

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
    public function create() {
        return view('listings.create');
    }

    //Store create form
    public function store(Request $request) {
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

        // $folder = public_path('../public/storage/' . Auth::id() . '/');

        // if (!Storage::exists($folder)) {
        //     Storage::makeDirectory($folder, 0775, true, true);
        // }

        // if($request->hasFile('logo')) {
        //     // Storage::makeDirectory(public_path('storage/newdirectory'));
        //     $formFields['logo'] = $request->file('logo')->store('logos/' . Auth::id() , 'public');
        // }



        //Add user_id same as logged in user's id when create listing
        $formFields['user_id'] = auth()->id();

        //Here is the class inserting newly created item into DB
        $new_listing = Listing::create($formFields);

        if($request->has('images')){
            foreach($request->file('images')as $image){
                $imageName = $formFields['title'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('images/external'),$imageName);
                Image::create([
                    'listing_id'=>$new_listing->id,
                    'image_name'=>$imageName
                ]);
            }
        }

        // Image::create(['listing_id'=>$new_listing->id]);

        // $listing_images = collect(['img_one', 'img_two', 'img_three', 'img_four', 'img_five', 'img_six', 'img_seven', 'img_eight', 'img_nine', 'img_ten']);

        // foreach($listing_images as $image) {

        //     if ($request->hasFile($image)) {

        //         $file = $request->$image;

        //         $name = $formFields['title'].'-image-'.time().rand(1,1000).'.'.$file->extension();

        //         $file->move(public_path('images/external/'),$name);

        //         // $new_listing->$image = $name; //I think this line is unnecessary

        //         // Image::save([
        //         //     'listing_id'=>$new_listing->id,
        //         //     $image => $name
        //         // ]);
        
        //         Image::where('listing_id', $new_listing->id)->update([
        //                 $image => $name
        //             ]);

        //         // $listing_images[$image] = $file->$name;

        //     }
        // }

        //redirect to listings page after created new listing, with a flash message.
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //Show edit form
    public function edit(Listing $listing) {
        // dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update listing data
    public function update(Request $request, Listing $listing) {

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

        $listingImage = Image::findOrFail($listing->id);

        $images = [];
        foreach ($request->file('images') as $image) {
            $imageName = time().'.'.$image->getClientOriginalExtension();
            //save images in public/images/listing folder
            $image->move(public_path('images/external/'), $imageName);
            // Delete the old photo
            $oldImagepath = $listingImage->image_name;
            File::delete($oldImagepath);
            $images[] = $imageName;
            $json_encode = json_encode($images);
            $listingImage->image_name = $json_encode;
        }

        $listingImage->save();

        //redirect to listings page after updated listing, with a flash message.
        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete listing
    public function destroy(Listing $listing) {
        
        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        //Delete images from drive (multiple rows)
        if (!$listing->images->isEmpty()) {
            foreach ($listing->images as $image) {
                unlink(public_path('images/external/').$image->image_name);
                // File::delete(public_path('images/external/').$image->image_name); //this also works
            }
        }

        // dd($listing->images);

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    //Manage listing
    public function manage() {
        return view('listings/manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
