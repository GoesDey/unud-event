@props (['filters' => [], 'title' => 'Sort', 'var' => 'sorts'])
@php
   $filterArray = is_array($filters) ? $filters : [$filters];
@endphp
<div class="relative w-fit rounded-lg border border-gray-300 bg-white" x-data="{ open: false }">
   <button
      type="button"
      class="flex cursor-pointer gap-2 px-4 py-2.5 text-sm font-normal"
      @click="open = !open"
   >
      <x-icons.filter class="size-5! text-gray-700!" />
      {{ $title }}
      @if (count($filterArray))
         <span
            class="flex size-5 items-center justify-center rounded-full bg-blue-500 text-xs text-white"
         >
            {{ count($filterArray) }}
         </span>
      @endif
   </button>

   <div
      x-cloak
      x-show="open"
      @click.outside="open = false"
      class="absolute left-0 z-10 mt-2 w-48 overflow-hidden rounded-lg border bg-white shadow-lg"
   >
      <div class="[&::-webkit-scrollbar]:hidden max-h-60 scrollbar-none overflow-y-auto py-1">
         {{ $slot }}
      </div>

      @if (count($filterArray))
         <hr class="my-1" />
         <button
            class="w-full cursor-pointer px-4 py-2 text-left text-sm text-red-500 hover:bg-gray-50"
            @click="
                $wire.set('{{ $var }}', []);
                open = false;
            "
         >
            Reset Filter
         </button>
      @endif
   </div>
</div>
