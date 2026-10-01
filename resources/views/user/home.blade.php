@extends ('layouts.user-layout')
@section ('title', 'Home')
@php
   $benefits = [
      'Tingkatkan Skill' => 'Belajar skill baru dari para ahli dan praktisi industri.',

      'Networking' => 'Bangun jaringan profesional dengan sesama mahasiswa dan praktisi.',

      'Raih Sertifikat' => 'Dapatkan sertifikat penghargaan untuk menambah portofolio Anda.',

      'Raih SKP' => 'Kumpulkan poin SKP melalui kegiatan akademik dan sosial.',
   ];
@endphp
@section ('content')
   <section class="-mx-16 -mt-16 flex items-center gap-16 bg-white p-16">
      <x-animation.slide-right class="w-2/5!">
         <div class="flex w-full flex-col items-center gap-9">
            <div class="flex flex-col gap-4">
               <h1 class="text-primary text-5xl leading-15 font-bold">Temukan Event Terbaikmu!</h1>
               <p class="text-primary text-xl">Jangan lewatkan kesempatan emas untuk mengembangkan skill dan memperluas jaringan anda di lingkungan Kampus!</p>
            </div>
            <a
               href="{{ route('events') }}"
               class="bg-secondary shadow-primary/25 flex w-full cursor-pointer items-center justify-center gap-2 rounded-lg p-3 shadow-md"
            >
               <span class="text-primary font-bold">Jelajahi Event</span>
               <x-icons.right-arrow stroke-width="3" class="text-primary" />
            </a>
         </div>
      </x-animation.slide-right>
      <x-animation.slide-left class="w-3/5!">
         <div
            x-data="{ isLoaded: false }"
            x-init="if ($refs.myImage && $refs.myImage.complete) isLoaded = true;"
            class="relative w-full overflow-hidden rounded-2xl bg-slate-200"
         >
            <div x-show="!isLoaded" class="absolute inset-0 animate-pulse bg-zinc-500"></div>

            <img
               x-ref="myImage"
               @load="isLoaded = true"
               :class="isLoaded ? 'opacity-100' : 'opacity-0'"
               class="h-full w-full object-cover transition-opacity duration-500 ease-in-out"
               src="{{ asset('assets/home/figure.png') }}"
               alt="event image"
               loading="lazy"
            />
         </div>
         {{-- <img class="w-full h-full" src="{{ asset('assets/home/figure.png') }}" alt=""> --}}
      </x-animation.slide-left>
   </section>
   <section class="py-16">
      <div class="text-primary mb-9 text-center text-4xl font-bold">
         <x-animation.slide-up>
            <h2>Keuntungan Mengikuti</h2>
         </x-animation.slide-up>
         <x-animation.slide-up duration="900"> Event dalam Kampus </x-animation.slide-up>
      </div>
      <x-animation.slide-up>
         <x-white-block class="rounded-4xl px-16! py-8!">
            <div class="flex justify-between">
               @foreach ($benefits as $title => $value)
                  <div class="flex w-49 flex-col gap-6">
                     <div class="flex justify-center">
                        <img
                           class="h-18 w-19.25"
                           src="{{ asset("assets/home/benefit-$loop->index.png") }}"
                           alt="benefit"
                        />
                     </div>
                     <div class="flex flex-col gap-4">
                        <h3 class="text-primary text-center font-bold">{{ $title }}</h3>
                        <p class="text-primary text-center">{{ $value }}</p>
                     </div>
                  </div>
               @endforeach
            </div>
         </x-white-block>
      </x-animation.slide-up>
   </section>
   <section class="-mx-16 bg-white p-16">
      <x-animation.slide-up>
         <h2 class="text-primary mb-9 text-center text-4xl font-bold">Jenis Event yang Tersedia</h2>
      </x-animation.slide-up>
      <x-animation.slide-right>
         <div class="flex w-full gap-6 overflow-x-auto pb-4">
            @foreach ($types as $type)
               <div
                  class="border-primary flex size-67 shrink-0 flex-col gap-5 rounded-4xl border-2 bg-white p-8"
               >
                  <h4 class="text-primary text-2xl font-bold">{{ $type->name }}</h4>
                  <p class="text-primary">{{ $type->description }}</p>
               </div>
            @endforeach
         </div>
      </x-animation.slide-right>
   </section>
   <section class="pt-16">
      <x-animation.slide-up>
         <div class="text-primary mb-9 flex flex-col gap-3 text-center text-4xl font-bold">
            <h2>Event Terdekat Saat ini</h2>
            <span class="text-primary text-2xl font-medium"
               >Jangan sampai ketinggalan event menarik !!</span
            >
         </div>
      </x-animation.slide-up>
      <x-animation.slide-up>
         <div class="flex flex-col gap-9">
            <div class="flex justify-center gap-5">
               @forelse ($events as $event)
                  <x-event-card :data="$event" />
               @empty
                  <div class="text-primary w-full text-4xl">Belum ada event untuk saat ini</div>
               @endforelse
            </div>
            <a
               href="{{ route('events') }}"
               class="bg-primary shadow-primary/25 mx-auto flex w-121 cursor-pointer items-center justify-center gap-2 rounded-lg p-3 shadow-md"
            >
               <span class="font-bold text-white">Jelajahi Event</span>
               <x-icons.right-arrow stroke-width="3" class="text-white" />
            </a>
         </div>
      </x-animation.slide-up>
   </section>
@endsection
