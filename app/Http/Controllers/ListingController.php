<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
            'listing' => $listing
        ]);
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

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos/' . Auth::id() , 'public');
        }

        //Add user_id same as logged in user's id when create listing
        $formFields['user_id'] = auth()->id();

        //Here is the class inserting newly created item into DB
        Listing::create($formFields);

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

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //Instead of using static method we should use reqular method
        $listing->update($formFields);

        //redirect to listings page after updated listing, with a flash message.
        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete listing
    public function destroy(Listing $listing) {
        
        //Make sure logged in user is the owner of the listing
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    //Manage listing
    public function manage() {
        return view('listings/manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
