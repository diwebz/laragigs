{{-- @extends('layout')

@section('content') --}}

<x-layout_imagecol>
  <a href="/" class="inline-block text-black ml-4 mb-4">
      <i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
      <x-card class="p-10">
          <div class="flex flex-col items-center justify-center text-center">
              {{-- <img class="w-48 mr-6 mb-6" src="{{$listing->image_name ? ('../storage/' . $listing->image_name) : ('/images/no_image.png')}}" alt=""/> --}}
              {{-- @unless ($listing->images_col->isEmpty())
                  @foreach ($listing->images_col as $image)
                  <figure>
                      <img src="/images/external/{{$image->img_one}}" class="w-48 mr-6 mb-6">
                      <img src="/images/external/{{$image->img_two}}" class="w-48 mr-6 mb-6">
                      <img src="/images/external/{{$image->img_three}}" class="w-48 mr-6 mb-6">
                      <img src="/images/external/{{$image->img_four}}" class="w-48 mr-6 mb-6">
                  </figure>
                  @endforeach
              @else
                  <figure>
                      <img src="/images/no_image.png" class="w-32 mx-auto h-full">
                  </figure>
              @endunless --}}

              @php
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
              @endphp

                @foreach ($listing_images as $image)
                    @if($listing->images_col[0]->$image)
                    <figure>
                      <img src="/images/external/{{$listing->images_col[0]->$image}}" class="w-48 mr-6 mb-6">
                    </figure>
                    @else
                    no image
                    @endif
                    {{-- {{$listing->images_col[0]->$image}} --}}
                @endforeach

              <div>
                ----------- seperator -----------
              </div>

              {{-- @foreach ($listing->images_col as $image) --}}
              
              <figure>
                @if($listing->images_col[0]->img_one)
                    <img src="/images/external/{{ $listing->images_col[0]->img_one }}" class="w-48 mr-6 mb-6">
                @endif
                @if($listing->images_col[0]->img_two)
                    <img src="/images/external/{{ $listing->images_col[0]->img_two }}" class="w-48 mr-6 mb-6">
                @endif
                @if($listing->images_col[0]->img_three)
                    <img src="/images/external/{{ $listing->images_col->first()->img_three }}" class="w-48 mr-6 mb-6">
                @endif
              </figure>
              {{-- @endforeach --}}
              
              {{-- <img src="/images/external/{{$listing->images_col->img_one}}" class="w-48 mr-6 mb-6"> --}}

              <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
              <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
              
              <x-listing-tags :tagsCsv="$listing->tags" />
                  
              <div class="text-lg my-4">
                  <i class="fa-solid fa-location-dot"></i>
                  {{$listing->location}}
              </div>
              <div class="border border-gray-200 w-full mb-6"></div>
              <div>
                  <h3 class="text-3xl font-bold mb-4">
                      Job Description
                  </h3>
                  <div class="text-lg space-y-6">
                      {{$listing->description}}

                      <a href="mailto:{{$listing->email}}"
                          class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80">
                          <i class="fa-solid fa-envelope"></i>
                          Contact Employer</a>

                      <a href="{{$listing->website}}"
                          target="_blank"
                          class="block bg-black text-white py-2 rounded-xl hover:opacity-80">
                          <i class="fa-solid fa-globe"></i> Visit
                          Website</a>
                  </div>
              </div>
          </div>
      </x-card>
      
      {{-- <x-card class="mt-4 p-2 flex space-x-6">
          <a href="/listings/{{$listing->id}}/edit">
              <i class="fa-solid fa-pencil"></i> Edit
          </a>

          <form method="POST" action="/listings/{{$listing->id}}">
              @csrf
              @method('DELETE')
              <button class="text-red-500">
                  <i class="fa-solid fa-trash"></i>Delete
              </button>
          </form>
      </x-card> --}}
  </div>
</x-layout_imagecol> 
{{-- @endsection --}}