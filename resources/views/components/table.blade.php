@props ([
   'theads' => [],
   'data' => null,
   'startCol' => '60px',
   'endCols' => ['120px'],
   'showAction' => false
])

@php
   $endColsArray = is_array($endCols) ? $endCols : [$endCols];
   $dynamicFieldCount = max(0, count($theads) - (1 + count($endColsArray)));
   // Pakai 1fr agar kolom tengah stretch memenuhi sisa ruang
   $middleCols = array_fill(0, $dynamicFieldCount, '1fr');
   $allCols = array_merge([$startCol], $middleCols, $endColsArray);
   $gridTemplate = implode(' ', $allCols);
@endphp

<div
   class="flex w-full flex-col overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm"
>
   {{-- HEAD --}}
   <div
      class="grid w-full border-b border-slate-200 bg-slate-50 text-sm font-semibold text-[#2d3359]"
      style="grid-template-columns: {{ $gridTemplate }};"
   >
      @foreach ($theads as $index => $head)
         <div
            @class ([
               'px-4 py-4 flex items-center justify-start',
               'justify-center!' => $index === 0,
               'justify-end!' => $loop->last
            ])
         >
            @if ($index === 0 && empty($head) && count($data) > 0)
               <x-input
                  type="checkbox"
                  {{
                     $attributes->whereStartsWith(
                        'wire:model',
                     )
                  }}
                  wire:confirm="Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan."
                  class="items-center text-indigo-600 focus:ring-indigo-500"
                  classInput="cursor-pointer"
               />
            @elseif ($loop->last && $showAction)
               <x-button
                  wire:click="$dispatch('delete-some-data')"
                  wire:confirm="Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan."
                  class="w-fit! py-0! text-gray-500 transition-colors hover:text-red-500"
               >
                  <x-icons.trash class="size-5! text-inherit!" />
               </x-button>
            @else
               {{ $head }}
            @endif
         </div>
      @endforeach
   </div>

   {{-- BODY --}}
   <div class="flex w-full flex-col divide-y divide-slate-100">{{ $slot }}</div>

   {{-- PAGINATION --}}
   @if ($data)
      <div class="flex items-center justify-between bg-white px-4 py-4">
         <button
            wire:click="previousPage"
            wire:loading.attr="disabled"
            @disabled ($data->onFirstPage())
            class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
         >
            Previous
         </button>

         <span class="text-sm font-medium text-[#2d3359]">
            Page {{ $data->currentPage() }} of {{ $data->lastPage() }}
         </span>

         <button
            wire:click="nextPage"
            wire:loading.attr="disabled"
            @disabled ($data->onLastPage())
            class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
         >
            Next
         </button>
      </div>
   @endif
</div>
