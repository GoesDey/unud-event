@props(['data' => []])

@php
     $infos = [
          'locate' => $data->location,
          'people' => $data->participants,
          'coin' => $data->price,
     ]
@endphp
{{-- @dd($data->picture) --}}
<div class="rounded-xl flex flex-col w-full h-fit overflow-hidden shadow-md shadow-primary/30">
     <div class="w-full h-137.5 relative">
          <img class="w-full h-full object-cover" src="{{ asset('storage/' . $data->picture) }}" alt="event image">
          <x-tag class="absolute! top-2 right-2 w-fit">{{ $data->eventType->name }}</x-tag>
     </div>
     <div class="bg-white rounded-t-[20px] -mt-4 px-4 pt-8 pb-3 z-50 shadow-2xl shadow-primary/25">
          <div class="flex flex-col gap-2 mb-4">
               <h4 class="font-bold text-2xl line-clamp-2">{{ $data->name }}</h4>
               <div class="flex gap-2">
                    @foreach ($data->categories->take(2) as $category)
                        <x-tag class="overflow-hidden" classText='truncate'>{{ $category->name }}</x-tag>
                    @endforeach
                    @if ($data->categories->count() > 2)
                        <x-tag class="shrink-0" icon='plus'>{{ $data->categories->count() - 2 }}</x-tag>
                    @endif
               </div>
               <div class="flex flex-col gap-2">
                    <div class="flex gap-2 items-center">
                         <x-icons.locate />
                         <p class="text-primary font-semibold">{{ Str::title($data->location) }}</p>
                    </div>
                    <div class="flex gap-2 items-center">
                         <x-icons.people />
                         @foreach ($data->participants as $participant)
                              <p class="text-primary font-semibold truncate">{{ $participant->name }}<span>{{ $loop->last ? ' ' : ', '  }}</span></p>
                         @endforeach
                    </div>
                    <div class="flex gap-2 items-center">
                         <x-icons.coins />
                         <p class="text-primary font-semibold">{{ $data->price > 0 ? 'Rp. '. number_format($data->price, 0, ',', '.') : 'Gratis' }}</p>
                    </div>
               </div>
          </div>
          <button class="w-full text-center gap-2 bg-secondary rounded-lg p-3 shadow-md shadow-primary/25 cursor-pointer">
               <span class="text-primary font-bold">Lihat Detail</span>
          </button>
     </div>
</div>