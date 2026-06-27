@extends('layouts.user-layout')
@section('title', 'Home')
@php
     $benefits = [
          'Tingkatkan Skill' => 'Belajar skill baru dari para ahli dan praktisi industri.',
     
          'Networking' => 'Bangun jaringan profesional dengan sesama mahasiswa dan praktisi.',
     
          'Raih Sertifikat' => 'Dapatkan sertifikat penghargaan untuk menambah portofolio Anda.',
     
          'Raih SKP' => 'Kumpulkan poin SKP melalui kegiatan akademik dan sosial.',
     ]     
@endphp
@section('content')
     <section class="-mx-16 -mt-16 p-16 bg-white flex items-center gap-16">
          <x-animation.slide-right class="w-2/5!">
               <div class="flex flex-col items-center gap-9 w-full">
                    <div class="flex flex-col gap-4">
                         <h1 class="text-5xl leading-15 text-primary font-bold">Temukan Event Terbaikmu!</h1>
                         <p class="text-xl text-primary">Jangan lewatkan kesempatan emas untuk mengembangkan skill dan memperluas jaringan anda di lingkungan Kampus!</p>
                    </div>
                    <button class="w-full flex items-center justify-center gap-2 bg-secondary rounded-lg p-3 shadow-md shadow-primary/25 cursor-pointer">
                         <span class="text-primary font-bold">Jelajahi Event</span>
                         <x-icons.right-arrow stroke-width="3" class="text-primary" />
                    </button>
               </div>
          </x-animation.slide-right>
          <x-animation.slide-left class="w-3/5!">
               <div 
                    x-data="{ isLoaded: false }" 
                    x-init="if ($refs.myImage && $refs.myImage.complete) isLoaded = true" 
                    class="relative w-full rounded-2xl overflow-hidden bg-slate-200">

                    <div x-show="!isLoaded" class="absolute inset-0 bg-zinc-500 animate-pulse"></div>
                    
                    <img x-ref="myImage"
                         @load="isLoaded = true"
                         :class="isLoaded ? 'opacity-100' : 'opacity-0'"
                         class="w-full h-full object-cover transition-opacity duration-500 ease-in-out" 
                         src="{{ asset('assets/home/figure.png') }}" 
                         alt="event image"
                         loading="lazy">
               </div>
               {{-- <img class="w-full h-full" src="{{ asset('assets/home/figure.png') }}" alt=""> --}}
          </x-animation.slide-left>
     </section>
     <section class="py-16">
          <div class="text-primary text-4xl font-bold text-center mb-9">
               <x-animation.slide-up>
                    <h2>Keuntungan Mengikuti</h2>
               </x-animation.slide-up>
               <x-animation.slide-up duration='900'>
                    Event dalam Kampus
               </x-animation.slide-up>
          </div>
          <x-animation.slide-up>
               <x-white-block class="px-16! py-8! rounded-4xl">
                    <div class="flex justify-between">
                         @foreach ($benefits as $title => $value)
                              <div class="flex flex-col gap-6 w-49">
                                   <div class="flex justify-center">
                                        <img class="h-18 w-19.25" src="{{ asset("assets/home/benefit-$loop->index.png") }}" alt="benefit">
                                   </div>
                                   <div class="flex flex-col gap-4">
                                        <h3 class="font-bold text-primary text-center">{{ $title }}</h3>
                                        <p class="text-primary text-center">{{ $value }}</p>
                                   </div>
                              </div>
                         @endforeach
                    </div>
               </x-white-block>
          </x-animation.slide-up>
     </section>
     <section class="-mx-16 p-16 bg-white">
          <x-animation.slide-up>
               <h2 class="text-primary text-4xl font-bold text-center mb-9">Jenis Event yang Tersedia</h2>
          </x-animation.slide-up>
          <x-animation.slide-right>
               <div class="overflow-x-auto flex gap-6 pb-4 w-full">
                    @foreach ($types as $type)
                         <div class="border-2 border-primary rounded-4xl bg-white p-8 flex flex-col gap-5 shrink-0 size-67">
                              <h4 class="font-bold text-2xl text-primary">{{ $type->name }}</h4>
                              <p class="text-primary">{{ $type->description }}</p>
                         </div>
                    @endforeach
                    
               </div>
          </x-animation.slide-right>
     </section>
     <section class="pt-16">
          <x-animation.slide-up>
               <div class="flex flex-col gap-3 text-primary text-4xl font-bold text-center mb-9">
                    <h2>Event Terdekat Saat ini</h2>
                    <span class="text-2xl text-primary font-medium">Jangan sampai ketinggalan event menarik !!</span> 
               </div>
          </x-animation.slide-up>
          <x-animation.slide-up>
               <div class="flex flex-col gap-9">
                    <div class="flex justify-center gap-5">
                         @forelse ($events as $event)
                              <x-event-card :data="$event" />
                         @empty
                              <div class="w-full text-4xl text-primary">
                                   Belum ada event untuk saat ini
                              </div>
                         @endforelse
                    </div>
                    <button class="w-121 mx-auto flex items-center justify-center gap-2 bg-primary rounded-lg p-3 shadow-md shadow-primary/25 cursor-pointer">
                         <span class="text-white font-bold">Jelajahi Event</span>
                         <x-icons.right-arrow stroke-width="3" class="text-white" />
                    </button>
               </div>
          </x-animation.slide-up>
     </section>
@endsection