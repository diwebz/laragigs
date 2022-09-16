Laravel project development (job listing system)
- Laravel Framework version 9.17.0
- mysql database
- tailwind.css (need to install package. check if installed in package-lock.json)
- 

### commands ###

- $ code . (this will open project in VScode. type this command inside root of the project dir. 
  don't login into ssh. in the terminal, just go to the root and type it.)

- create an eloquent model : php artisan make:model Listing

- create migration table : php aritsan make:migration create_listings_table
- Then,, run this command to create tables : php artisan migrate
  this command will create tables for all migration files in migrations directory.

- seed table by factory : php artisan db:seed
  This will insert dummy data into tables with dummy data factory in 
  ./database/seeders/DatabaseSeeder.php file.

- refresh tables : php artisan migrate:refresh
  ex: if you commented out factory seeding code in DatabaseSeeder.php file and 
  run this command will erase all dummy data by refreshing that table.

- And if you want to re-seed tables, run this command : php artisan migrate:refresh --seed

- Create Factory file for dummy data : php artisan make:factory ListingFactory

- Create Controller : php artisan make:controller ListingController

- php artisan vendor:publish ,,,in this command you can publish variuos blade template packages included
  in laravel vendor. ex: you can install pagination.. then select bootstrap.blade or tailwind.blade or another template. look into the documentation for the correct coding or way to choose that template.. you can select which package to install after running that command by typing the number of the package.

  php artisan vendor:publish

  Which provider or tag's files would you like to publish?:
  [0 ] Publish files from all providers and tags listed below
  [1 ] Provider: Clockwork\Support\Laravel\ClockworkServiceProvider
  [2 ] Provider: Illuminate\Foundation\Providers\FoundationServiceProvider
  [3 ] Provider: Illuminate\Mail\MailServiceProvider
  [4 ] Provider: Illuminate\Notifications\NotificationServiceProvider
  [5 ] Provider: Illuminate\Pagination\PaginationServiceProvider
  [6 ] Provider: Laravel\Sail\SailServiceProvider
  [7 ] Provider: Laravel\Sanctum\SanctumServiceProvider
  [8 ] Provider: Laravel\Tinker\TinkerServiceProvider
  [9 ] Provider: Spatie\LaravelIgnition\IgnitionServiceProvider
  [10] Tag: flare-config
  [11] Tag: ignition-config
  [12] Tag: laravel-errors
  [13] Tag: laravel-mail
  [14] Tag: laravel-notifications
  [15] Tag: laravel-pagination
  [16] Tag: sail
  [17] Tag: sail-bin
  [18] Tag: sail-docker
  [19] Tag: sanctum-config
  [20] Tag: sanctum-migrations

- php artisan storage:link ,,,create symlink for the first time to creat file path. ex: images uploaded from insert form.

- php artisan tinker ... start tinker shell. (tinker is a command line tool can run php commands directly like curl.)
  example commands: 
  \App\Models\Listing::first() //show the listing with first id.
  \App\Models\Listing::find(3) //show listing id 3
  \App\Models\Listing::find(3)->user //show user owns the listing id 3
  $user = App\Models\User::first() //show user has first id
  $user->listings //show all listings belong to that user
  \App\Models\User::find(2)->listings //show all listings belongs to user id 2

### Directives ###
directives should start from the @ symbol

@foreach @endforeach

@php @endphp

@unless @else @endunless (this directive can use instead of using @if @else Conditional)

@yield

@props(['name']) (mostly use to combine components with variables retrieving data from database)

@csrf prevent from Cross sites scripting attacks. Usually use for forms with POST requests.

@method This directive similar to the form method="". In the edit form we should use PUT method because it's an update but we can't write it in the form method. So we can use @method directive instead of using method inside form tag.


### Helpers ###

- old helper : value="{{old('title')}}"



### Conditionals ###

@if @else @endif




### important points ###

- http response status 200 (status 200 mean everything is okay). in other words, Response headers

- show single listing should be at the bottom in the Routes file.

- use @csrf for form submisions.

- fillable error when create new listing.
  Add [title] to fillable property to allow mass assignment on [App\Models\Listing].
  (input fields should insert as fillable properties into DB according to laravel.
  This can be fixed by adding protected $fillable to Listing.php or adding Model::unguard();
  into the boot section in AppServiceProvider.php. I think this is a security error.
  So you should find correct ways to fix this.)

- $table->foreignId('user_id')->constrained()->onDelete('cascade');
  This line located in migrations -> listing table. It means, user_id is a foreignId of main id.. and if this user deleted from db, all listings created by that user also deleted automatically.

### files and structure ###

I'm touching these areas,
1. Routes - Routes handle URL paths to view pages. Route settings are in /routes/web.php file (this is 
   the default Route file). And also we can set response status(like 200, 404, 403...), custom headers etc 
   in this file (in other words, Response headers). Those responses can check in the chrome developer 
   tool's network tab.

2. api.php - located in routes dir. this file can use to build an api.
   ex: check below code. It can parse json data. URL should be http://laragigs.test/api/
   Route::get('/posts', function() {
    return response()->json([
        'posts' => [
            [
                'title' => 'Post one'
            ]
        ]
    ]);
   });

3. laravel eloquent ORM (Object Relational Maper). located in /App/Models/here...
   In models you can do some functions like find, find all etc. The data inside DB are coming from models.
   Simply, retrieving data from DB will be done by models.

4. components - this can use to seperate some parts of retrieving data from DB into x-card feature


### new tools and things ###

- php namespace resolver : this vscode extension helps to add classes
- php inteliphense : vscode extension that helps coding

- clockwork chrome extension and clockwork laravel package. Install both. 
  Will show you requests, queries... etc. in the developer tool clockwork tab.

- tinker : is a command line tool can run php commands like curl.

### php/laravel coding patterns and methods ###

- dd($id) : die dump (debugging method)
- ddd($id) : die dump and debug (debugging method)

- this is in the web.php file. Route for get value from the URL
  ex: URL will be http://laragigs.test/search?name=Nadun&city=Tokyo

  Route::get('/search', function(Request $request) {
      // dd($request);
      return response($request->name . ' ' . $request->city);
      //or you don't need to write "response". just write it like
      //return $request->name . ' ' . $request->city;
  });

  So above code gives the result of "Nadun Tokyo".

  Route::get('/search', function(Request $request) {

  "Request" inside function() is to get the response and $request is the variable. In this case variables are,
  name and city.

- blade templates : laravel's template engine. shortened php codes can write only in blade templates.
  ex: variables inside curly bracers {{$heading}}

- <x- ></x- > tag is a blade template feature can use common tag in multiple files(like in components).
  ex: if you use some div tag, in card.blade.php you can seperate that div and insert into component file.
      $slot is a variable can view everything inside <x-card> div
      <div {{attriutes->merge(['class' => 'bg-black card p-10'])}}
        {{$slot}}
      </div>

      and in your views files can use below tag to read the above common div tag
      <x-card>  </x-card>

- Basic workflow is, create a Route, then Controller, then View.

- Middleware , can apply to prevent accessing pages without logged in, like post job, edit listing etc...


### Points still can't understand ###

1. combination with props and <x-listing-card>... Usage of $listing and $tagsCsv variable..etc
2. difference between x-card and x-layout




### upgrading ###

1. create folder and upload images

https://stackoverflow.com/questions/28576112/how-to-create-a-folder-inside-a-folder-using-laravel
https://stackoverflow.com/questions/48853770/dynamically-create-a-new-folder-when-uploading-images-in-laravel-5-5
https://stackoverflow.com/questions/63090912/laravel-how-to-create-a-folder-in-public-path-dynamically-when-a-file-is-upload
https://stackoverflow.com/questions/54995284/how-to-create-a-directory-and-file-in-laravel
https://stackoverflow.com/questions/21320304/laravel-image-upload-creating-folder-instead-of-file
https://laracasts.com/discuss/channels/laravel/laravel-custom-file-system-configuration?page=1&replyId=453633


https://www.youtube.com/watch?v=a8XW_FvADIM
https://www.youtube.com/watch?v=SonhvOpBnMc