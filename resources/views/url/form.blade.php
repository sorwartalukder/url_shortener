 <x-guest-layout>

     @if (Route::has('login'))
     <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
         @auth
         <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Dashboard</a>
         @else
         <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Log in</a>

         @if (Route::has('register'))
         <a href="{{ route('register') }}" class="ml-4 bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap">Register</a>
         @endif
         @endauth
     </div>
     @endif

     <div class="w-full flex justify-center items-center">
         <form class="w-full" action="{{ route('home') }}" method="post">
             @csrf
             <label class="block mb-2 text-center text-xl" for="url">Paste the URL to be shortened</label>
             <div class="flex max-w-md mx-auto">
                 <input class="w-full text-black" type="url" name="url" required>
                 <button class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-800 whitespace-nowrap" type="submit">Shorten URL</button>
             </div>
         </form>
     </div>

 </x-guest-layout>