<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>
      UNUD Events |
      @yield ('title')
   </title>
   @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

@php
   $menus = [
      [
         'title' => 'Beranda',
         'isActive' => request()->is('home') || request()->is('/'),
         'to' => '/',
      ],
      [
         'title' => 'Events',
         'isActive' => false,
         'to' => '/events',
      ],
      [
         'title' => 'FAQ',
         'isActive' => false,
         'to' => '/faq',
      ],
   ];
@endphp

<body class="font-inter bg-soft-blue">
   <header class="fixed z-999 bg-white top-0 w-full">
      <nav class="flex items-center justify-between px-30 py-6 text-xl font-bold shadow-lg">
         <div class="flex items-center gap-2.5">
            <x-icons.logo />
            <h1 class="text-primary">UNUD <span class="block">Events</span></h1>
         </div>
         <div class="flex flex-row gap-12">
            @foreach ($menus as $item)
               <a
                  wire:navigate
                  @class ([
                     'text-primary' => !$item['isActive'],
                     'text-secondary' => $item['isActive']
                  ])
                  href="{{ $item['to'] }}"
                  >{{ $item['title'] }}</a
               >
            @endforeach
         </div>
      </nav>
   </header>
   <div class="flex min-h-screen flex-col">
      <main class="mt-25 grow px-20 py-16">
         @yield ('content')
      </main>
      <footer class="bg-primary p-12 text-white">
         <div class="flex justify-between">
            <div class="w-1/2">
               <div class="mb-6 flex items-center gap-2.5">
                  <x-icons.logo />
                  <h1 class="text-xl font-bold text-white">
                     UNUD <span class="block">Events</span>
                  </h1>
               </div>
               <p class="mb-4 w-1/2">Platform terpadu untuk menemukan dan mengikuti berbagai event kampus di seluruh Indonesia.</p>
               <div class="flex gap-3">
                  <a href="">
                     <x-icons.twitter class="size-6 fill-white" />
                  </a>
                  <a href="">
                     <x-icons.facebook class="size-6 fill-white" />
                  </a>
                  <a href="">
                     <x-icons.instagram class="size-6 fill-white" />
                  </a>
               </div>
            </div>
            <div class="flex w-1/2 justify-between">
               <div class="">
                  <h1 class="mb-6 text-xl font-bold">Navigation</h1>
                  <div class="flex flex-col gap-4">
                     @foreach ($menus as $menu)
                        <a
                           href="{{ $menu['to'] }}"
                           wire:navigate
                           class="font-medium"
                           >{{ $menu['title'] }}</a
                        >
                     @endforeach
                  </div>
               </div>
               <div class="">
                  <h1 class="mb-6 text-xl font-bold">Contact</h1>
                  <div class="flex flex-col gap-4">
                     <p class="font-medium">+62 812-3456-7890</p>
                     <p class="font-medium">udayana-events@gmail.com</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="mx-auto mt-10 w-3/5 border-t-2 pt-6 text-center">
            &copy; Udayana Events. All rights reserved.
         </div>
      </footer>
   </div>

   @livewireScripts
</body>
</html>
