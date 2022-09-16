@if (session()->has('message'))
  <div x-data="{popup: true}" x-init="setTimeout(() => popup = false, 4000)"
    x-show="popup" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel 
    text-white text-center w-full md:w-6/12 py-3">
    <p>
      {{session('message')}}
    </p>
  </div>
@endif