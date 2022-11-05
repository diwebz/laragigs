<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4">
      <i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
      <x-card class="p-10">
          <div class="flex flex-col items-center justify-center text-center">
            <div class="panel-body">
       
              @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        
                  @foreach(Session::get('images') as $image)
                      <img src="/images/external/{{ $image['image_name'] }}" width="300px">
                  @endforeach
              @endif
            
              <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
        
                  <div class="mb-3">
                      <label class="form-label" for="inputImage">Select Images:</label>
                      <input 
                          type="file" 
                          name="images[]" 
                          id="inputImage"
                          multiple 
                          class="form-control @error('images') is-invalid @enderror">
        
                      @error('images')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
         
                  <div class="mb-3">
                      <button type="submit" class="btn btn-success">Upload</button>
                  </div>
             
              </form>
            
            </div>
          </div>
      </x-card>
  </div>
</x-layout> 