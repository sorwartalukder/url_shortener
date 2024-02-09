 <x-guest-layout>
     <div class="flex justify-center items-center">
         <p>Original URL: {{ $originalUrl }}</p>
         <p>Shortened URL: {{ url($shortUrl) }}</p>
     </div>
 </x-guest-layout>