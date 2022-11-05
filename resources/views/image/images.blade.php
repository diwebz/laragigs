{{-- @extends('layout')

@section('content') --}}

<x-layout>
    <a href="/" class="inline-block text-black ml-4 mb-4">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <h2>Images for product : <span class="text-primary">{{$listing->title}}</span> </h2>
                <div class="row mt-4">
                  @unless ($listing->images->isEmpty())
                    @foreach ($images as $image)
                      <img src="/images/external/{{$image->image_name}}" class="w-32 mx-auto h-full">
                    @endforeach
                  @else
                    <img src="/images/no_image.png" class="w-32 mx-auto h-full">
                  @endunless
                    
                </div>
            </div>
        </x-card>
    </div>
</x-layout> 
{{-- @endsection --}}