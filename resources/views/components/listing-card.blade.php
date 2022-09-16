@props(['listing'])

<x-card>
  <div class="block md:flex text-center md:text-left">
    <a href="/listings/{{$listing->id}}">
      <img class="w-32 mx-auto h-full md:w-48 md:mr-6 md:ml-0 md:block" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no_image.png')}}" alt=""/>
      {{-- <img class="w-32 mx-auto h-full md:w-48 md:mr-6 md:ml-0 md:block" src="{{$listing->logo ? ('storage/' . $listing->logo) : ('/images/no_image.png')}}" alt=""/> --}}
      <div>
          <h3 class="text-2xl">
          {{$listing->title}}
          </h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
          <x-listing-tags :tagsCsv="$listing->tags" />
          <div class="text-lg mt-4">
              <i class="fa-solid fa-location-dot"></i>
              {{$listing->location}}
          </div>
      </div>
    </a>
  </div>
</x-card>