@extends('layouts.user-layout')
@section('title', 'Detail Event')
@section('content')
     <a href="{{ $backUrl }}" class="flex gap-2 mb-4 items-center font-medium text-2xl text-primary">
          <x-icons.left-arrow />
          Kembali
     </a>
     <div class="flex flex-col gap-3 mb-6">
          <x-animation.slide-right><h1 class="text-primary text-[40px] font-bold">{{ $event->name }}</h1></x-animation.slide-right>
          <x-animation.slide-right>
               <div class="flex gap-3">
                    <div class="px-3 py-2 w-fit border-2 border-primary rounded-lg font-medium text-primary">
                         {{ $author->name }}
                    </div>
                    <div class="px-3 py-2 w-fit border-2 border-primary rounded-lg font-medium text-primary">
                         {{ $author->faculty->name }}
                    </div>
               </div>
          </x-animation.slide-right>
     </div>
     <x-animation.slide-right>
          <div class="flex gap-3 mb-6">
               <x-tag icon='type'>{{ $eventType->name }}</x-tag>
               @foreach ($categories as $category)
                   <x-tag icon='tag'>{{ $category->name }}</x-tag>
               @endforeach
          </div>
     </x-animation.slide-right>
     <div class="flex gap-5">
          {{-- @dd($event->picture) --}}
          <div class="flex flex-col gap-5 grow">
               <x-animation.slide-right>
                    <x-white-block class="flex flex-col gap-4 h-fit">
                         <h2 class="font-semibold text-xl text-primary">Deskripsi Event</h2>
                         <p class="text-primary">{{ $event->description }}</p>
                    </x-white-block>
               </x-animation.slide-right>
               <x-animation.slide-right>
                    <x-white-block class="flex flex-col gap-4 h-fit">
                         <h2 class="font-semibold text-xl text-primary">Timeline</h2>
                         <div class="flex flex-col gap-0 ">
                              @foreach ($timelines as $timeline)
                                  <div class="flex gap-4 items-start">
                                        <div class="flex flex-col">
                                             <x-icons.double-dot />
                                             @if (!($loop->last))
                                                  <div class="w-full flex justify-center">
                                                       <div class="rounded-full w-0.5 h-12 bg-black"></div>
                                                  </div>
                                             @endif
                                        </div>
                                        <div class="flex flex-col gap-1 items-start">
                                             <h4 class="text-primary">{{ $timeline->waktu_format }}</h4>
                                             <p class="text-primary font-medium">{{ $timeline->description }}</p>
                                        </div>
                                  </div>
                              @endforeach
                         </div>
                    </x-white-block>
               </x-animation.slide-right>
               @foreach ($detailEvents as $detail)
                    <x-animation.slide-right>
                         <x-white-block class="flex flex-col gap-4 h-fit">
                              <h2 class="font-semibold text-xl text-primary">{{ $detail->label }}</h2>
                              <p class="text-primary">{{ $detail->value }}</p>
                         </x-white-block>
                    </x-animation.slide-right>
               @endforeach
          </div>
          <div class="w-102 h-fit flex flex-col gap-5">
               <x-animation.slide-left>
                    <img class="rounded-xl w-full h-full object-cover" src="{{ asset('storage/' . $event->picture) }}" alt="event-picture">
               </x-animation.slide-left>
              
               <x-animation.slide-left>
                    <x-white-block class="flex flex-col gap-4 h-fit">
                         <h2 class="font-semibold text-xl text-primary">Informasi Pendaftaran</h2>
                         <div class="flex flex-col gap-2">
                              <div class="flex gap-2 items-center">
                                   <x-icons.people />
                                   @foreach ($participants as $participant)
                                        <p class="text-primary font-semibold truncate">{{ $participant->name }}<span>{{ $loop->last ? ' ' : ', '  }}</span></p>
                                   @endforeach
                              </div>
                              <div class="flex gap-2 items-center">
                                   <x-icons.locate />
                                   <p class="text-primary font-semibold">{{ Str::title($event->location) }}</p>
                              </div>
                              <div class="flex gap-2 items-center">
                                   <x-icons.coins />
                                   <p class="text-primary font-semibold">{{ $event->price > 0 ? 'Rp. '. number_format($event->price, 0, ',', '.') : 'Gratis' }}</p>
                              </div>
                         </div>
                         <a href="{{ $event->link }}" class="w-full flex items-center justify-center gap-2 bg-secondary text-primary font-bold rounded-lg p-3 shadow-md shadow-primary/25 cursor-pointer">
                              Daftar Sekarang
                              <x-icons.square-arrow-out />
                         </a>
                    </x-white-block>
               </x-animation.slide-left>
          </div>
     </div>
@endsection