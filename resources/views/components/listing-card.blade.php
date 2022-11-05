@props(['listing'])

<x-card>
  <div class="block md:flex text-center md:text-left">
    <a href="/listings/{{$listing->id}}">
      {{-- <img class="w-32 mx-auto h-full md:w-48 md:mr-6 md:ml-0 md:block" src="{{$listing->image_name ? ('storage/' . $listing->image_name) : ('/images/no_image.png')}}" alt=""/> --}}
      {{-- @foreach ($images as $image)
          <div class="col-md-3">
          <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
              <div class="card-body">
              <img src="{{$image->image_name ? ('../storage/' . $image->image_name) : ('/images/no_image.png')}}" class="w-48 mr-6 mb-6">
              </div>
          </div>
          </div>
      @endforeach --}}
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