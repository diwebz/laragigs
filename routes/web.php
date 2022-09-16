<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Basic Route testings for my reference
// Route::get('/hello', function () {
//     return response('<h1>hello world</h1>', 200)
//     -> header ('Content-Type', 'text/plain')
//     // actually here you can craete custom headers too.. like below
//     -> header ('foo', 'bar');
// });

// Route::get('/posts/{id}', function ($id) {
//     // dd($id);
//     // ddd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request) {
//     // dd($request);
//     return response($request->name . ' ' . $request->city);
//     //or you don't need to write "response". just write it like
//     //return $request->name . ' ' . $request->city;
// });


// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - update listing
// destroy - Delete listing

//All listings
Route::get('/', [ListingController::class, 'index']

    // return view('listings', [
    //     // 'heading' => 'All Listings',
    //     'listings' => Listing::all()
    // ]);
);

//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
//update should be a PUT request

//Delete listing
Route::delete('/listings/{listing}/', [ListingController::class, 'destroy'])->middleware('auth');

//Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Single Listing (single listing should be at the bottom. 
//If not /listings/{listing} will run everytime for above requests.)
Route::get('/listings/{listing}', [ListingController::class, 'show']

    //in here function (Listing $listing) automatically has 404 functionality
    //So you don't need to write if else condition for 404 here 
    // return view('listing', [
    //     'listing' => $listing
    // ]);    
);

//Show user registration form
Route::get('/register', [userController::class, 'register'])->middleware('guest');

//Store user data
Route::post('/users', [userController::class, 'store']);

//User logout
Route::post('/logout', [userController::class, 'logout'])->middleware('auth');

//Show user login form
Route::get('/login', [userController::class, 'login'])->name('login')->middleware('guest');

//User login
Route::post('/users/loggedin', [userController::class, 'loggedin']);