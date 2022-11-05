<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="images/favicon.ico" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

{{-- <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script> --}}
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    laravel: "#ef3b2d",
                },
            },
        },
    };
</script>
</head>
<body class="mb-48">
  <nav class="flex justify-between items-center mb-4">
    <a href="/">
      <img class="w-24" src="{{('/images/laravel_logo.jpg')}}" alt="" class="logo"/>
    </a>
    <ul class="flex space-x-4 px-4 text-lg">
      @auth
      <li>
        <span class="font-bold uppercase">
          Welcome {{auth()->user()->name}}
        </span>
      </li>
      <li>
        <a href="/listings/manage_imagecol" class="hover:text-laravel">
          <i class="fa-solid fa-gear"></i>
            Manage imagecol Listings
        </a>
      </li>
      <li>
        <form method="POST" action="/logout" class="inline">
          @csrf
          <button type="submit">
            <i class="fa-solid fa-door-closed"></i> Logout
          </button>
        </form>
      </li>
      @else
      <li>
        <a href="/register" class="hover:text-laravel">
          <i class="fa-solid fa-user-plus"></i>
           Register
        </a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel">
          <i class="fa-solid fa-arrow-right-to-bracket"></i>
            Login
        </a>
      </li>
      @endauth
    </ul>
  </nav>

  <main>

  {{-- VIEW OUTPUT --}}
  {{-- @yield('content') --}}

  {{$slot}}

  </main>

  <footer class="fixed bottom-0 left-0 w-full flex items-center flex-col-reverse md:flex-col font-bold bg-laravel text-white h-24 mt-24 opacity-90 justify-center">
      <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

      <a href="/listings/create_imagecol" class="md:absolute top-1/3 right-10 bg-black text-white mb-1 md:mb-0 py-2 px-5">
        Post a Job
      </a>
  </footer>

  <x-flash-message />

  {{-- <script>

    // attach our event listener on all the inputs
    let imgInputs = document.querySelectorAll('.js-img-input');
    let imgViews = document.querySelectorAll('.js-img-view');
    
    imgInputs.forEach(function(input){
      input.addEventListener('change', readURL);
      });

    function readURL(evt) {
      if (this.files[0]) {
        // here we can use 'this', it will be the input
        var img = this.nextElementSibling;
        // not really needed in this case but it's a good habit to revoke the blobURI when done
        img.onload = function(){URL.revokeObjectURL(this.src)};
        
        this.parentElement.classList.add("is-selected");
        img.src = URL.createObjectURL(this.files[0]);

        console.log(this.files);
      } else {
        console.log("no files selected");
      }
    }

    //Remove selected image and replace default image URL
    imgViews.forEach(function(ee){
      ee.addEventListener('click', defaultURL);
      });

    function defaultURL() {

      const dt = new DataTransfer()
      
      this.previousElementSibling .files = dt.files;

      console.log(this.previousElementSibling .files);

      this.parentElement.classList.remove("is-selected");
      this.src = ('/images/thumbnails_default.jpg');
    }

  </script> --}}


  {{-- <script>
  
    let imgInputs = document.querySelectorAll('.js-img_externals');

    imgInputs.forEach(function(input){
      input.addEventListener('click', clickbttn);
      });

      var cloned = {};

      function clickbttn(evt) {
        var fileElement = event.target;
        cloned[fileElement.id] = fileElement.cloneNode();
        // li.appendChild(document.createTextNode("Water"));

        fileElement.parentElement.insertBefore(fileElement);
        fileElement.remove();

        console.log(cloned);
      }

  </script> --}}


  {{-- <script>
    // Get a reference to our file input
    const fileInput = document.querySelector('.deleteInput');

    // Create a new File object
    const myFile = new File([''], 'xxxx', {
        type: 'text/plain',
        lastModified: new Date(),
    });

    // Now let's create a FileList
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(myFile);
    fileInput.files = dataTransfer.files;

    // Help Safari out
    if (fileInput.webkitEntries.length) {
        fileInput.dataset.file = `${dataTransfer.files[0].name}`;
    }
  </script> --}}

</body>
</html>