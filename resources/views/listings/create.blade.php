<x-layout>
  <x-card class="p-10 max-w-lg mx-4 md:mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create a Gig
        </h2>
        <p class="mb-4">Post a gig to find a developer</p>
    </header>

    <form method="POST" action="/listings" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
          <label
              for="company"
              class="inline-block text-lg mb-2"
              >Company Name</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="company" value="{{old('company')}}"
          />

          @error('company')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label for="title" class="inline-block text-lg mb-2"
              >Job Title</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="title"
              placeholder="Example: Senior Laravel Developer"
              value="{{old('title')}}"
          />

          @error('title')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label
              for="location"
              class="inline-block text-lg mb-2"
              >Job Location</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="location"
              placeholder="Example: Remote, Boston MA, etc"
              value="{{old('location')}}"
          />

          @error('location')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label for="email" class="inline-block text-lg mb-2"
              >Contact Email</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="email" value="{{old('email')}}"
          />

          @error('email')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label
              for="website"
              class="inline-block text-lg mb-2"
          >
              Website/Application URL
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="website" value="{{old('website')}}"
          />

          @error('website')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label for="tags" class="inline-block text-lg mb-2">
              Tags (Comma Separated)
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="tags"
              placeholder="Example: Laravel, Backend, Postgres, etc"
              value="{{old('tags')}}"
          />

          @error('tags')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      {{-- <div class="mb-6">
          <label
              for="folder"
              class="inline-block text-lg mb-2"
              >Image folder</label
          >
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="folder"
              placeholder="Example: company name"
              value="{{old('folder')}}"
          />

          @error('folder')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div> --}}

      <div class="mb-6">
          <label for="listing-images" class="inline-block text-lg mb-2">
              Listing images
          </label>
          {{-- <input
              type="file"
              class="border border-gray-200 rounded p-2 w-full"
              name="logo"
          /> --}}
          <div class="listing-images flex flex-wrap">
            <div class="btn-img_upload">
              <label for="img_one" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>                
              </label>
              <input 
                id="img_one"
                type="file" 
                name="images[]"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_two" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_two"
                type="file" 
                name="images[]"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_three" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_three"
                type="file" 
                name="images[]"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            {{-- <div class="btn-img_upload">
              <label for="img_four" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_four"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_five" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_five"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div> --}}
            {{-- <div class="btn-img_upload">
              <label for="img_six" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_six"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_seven" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_seven"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_eight" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_eight"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_nine" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_nine"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div>
            <div class="btn-img_upload">
              <label for="img_ten" class="inline-block p-2 border-solid border border-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>                
              </label>
              <input 
                id="img_ten"
                type="file" 
                name="images"
                class="border border-gray-200 rounded p-2 w-full hidden" 
                accept="image/*"
              />
            </div> --}}
          </div>

          @error('logo')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
          <label
              for="description"
              class="inline-block text-lg mb-2"
          >
              Job Description
          </label>
          <textarea
              class="border border-gray-200 rounded p-2 w-full"
              name="description"
              rows="10"
              placeholder="Include tasks, requirements, salary, etc"
              >{{old('description')}}</textarea>

          @error('description')
            <p class="text-red-500 text-xs mt-1">
              {{$message}}
            </p>
          @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Create Gig
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>