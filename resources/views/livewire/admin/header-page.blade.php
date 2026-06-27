<div class="flex w-full items-center justify-between">
   <div class="flex flex-col">
      <div class="flex items-center text-sm font-medium text-slate-400">
         <span>Pages</span>
         <span class="mx-1">/</span>

         @foreach ($breadcrumbs as $crumb)
            @if (!$loop->last)
               <a
                  wire:navigate
                  href="{{ $crumb['url'] ?? '#' }}"
                  class="transition-colors hover:text-slate-600"
               >
                  {{ $crumb['label'] }}
               </a>
               <span class="mx-2">/</span>
            @else
               <span class="font-bold text-[#707EAE]">{{ $crumb['label'] }}</span>
            @endif
         @endforeach
      </div>

      <h1 class="mt-2 font-bold text-[#2B3674]">{{ end($breadcrumbs)['label'] }}</h1>
   </div>

   <div
      class="flex items-center space-x-3 rounded-full border border-slate-100 bg-white p-2 shadow-sm"
   >
      @if ($isSearch)
         <div
            class="relative flex h-10 w-64 items-center rounded-full bg-slate-50 focus-within:ring-2 focus-within:ring-[#2B3674]"
         >
            <div class="grid h-full w-10 place-items-center text-slate-400">
               <x-icons.search class="size-2.75! text-[#2B3674]!" />
            </div>
            <input
               type="text"
               wire:model.live.debounce.300ms="search"
               class="h-full w-full bg-transparent pr-4 text-sm text-[#2B3674] placeholder-[#8F9BBA] outline-none"
               placeholder="Search..."
            />
         </div>
      @endif

      <div class="h-8 w-8 overflow-hidden rounded-full border border-slate-300 bg-slate-200">
         <img
            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=0D8ABC&color=fff"
            alt="Profile"
            class="h-full w-full object-cover"
         />
      </div>
   </div>
</div>
