@props (['data' => []])

@php
   $infos = [
      'locate' => $data->location,
      'people' => $data->participants,
      'coin' => $data->price,
   ];
@endphp
{{-- @dd($data->picture) --}}
<div
   class="shadow-primary/30 flex w-full flex-col self-stretch overflow-hidden rounded-xl shadow-md"
>
   <div class="relative h-137.5 w-full">
      <img
         class="h-full w-full object-cover"
         src="{{ asset('storage/' . $data->picture) }}"
         alt="event image"
      />
      <x-tag class="absolute! top-2 right-2 w-fit">{{ $data->eventType->name }}</x-tag>
   </div>
   <div
      class="shadow-primary/25 z-50 -mt-4 flex grow flex-col rounded-t-[20px] bg-white px-4 pt-8 pb-3 shadow-2xl"
   >
      <div class="mb-4 flex flex-1 flex-col gap-2">
         <div class="flex-1 items-center flex">
            <h4 class="line-clamp-2 text-2xl font-bold">{{ $data->name }}</h4>
         </div>
         <div class="flex gap-2">
            @foreach ($data->categories->take(2) as $category)
               <x-tag class="overflow-hidden" classText="truncate">{{ $category->name }}</x-tag>
            @endforeach
            @if ($data->categories->count() > 2)
               <x-tag class="shrink-0" icon="plus">{{ $data->categories->count() - 2 }}</x-tag>
            @endif
         </div>
         <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
               <x-icons.locate />
               <p class="text-primary font-semibold">{{ Str::title($data->location) }}</p>
            </div>
            <div class="flex items-center gap-2">
               <x-icons.people />
               <p class="text-primary truncate font-semibold">
                  {{
                     $data->participants
                        ->pluck('name')
                        ->implode(', ')
                  }}
               </p>
            </div>
            <div class="flex items-center gap-2">
               <x-icons.coins />
               <p class="text-primary font-semibold">{{
                  $data->price > 0
                     ? 'Rp. ' . number_format($data->price, 0, ',', '.')
                     : 'Gratis'
               }}</p>
            </div>
         </div>
      </div>
      <a
         href="{{ route('event-detail', $data->id) }}"
         class="bg-secondary text-primary shadow-primary/25 block w-full cursor-pointer gap-2 rounded-lg p-3 text-center font-bold shadow-md"
      >
         Lihat Detail
      </a>
   </div>
</div>
