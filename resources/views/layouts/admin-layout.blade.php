<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>
      {{
         auth()->user()?->role == 'admin'
            ? 'Admin'
            : 'Super Admin'
      }} UNUD Events |
      @if (isset($title))
         {{ $title }}
      @else
         @yield ('title')
      @endif
   </title>
   @vite (['resources/css/app.css', 'resources/js/app.js'])

   @if (auth())
      @vite (['resources/js/superadmin.js', 'resources/js/admin.js'])
   @endif
</head>

@php
   $userRole = auth()->user()->role;
   $menus = match ($userRole) {
      'admin' => [
         [
            'title' => 'Dashboard',
            'isActive' => request()->routeIs('admin.dashboard'),
            'to' => route('admin.dashboard'),
            'icon' => 'house',
         ],
         [
            'title' => 'Manajemen Event',
            'isActive' => request()->routeIs('admin.manage-event*'),
            'to' => route('admin.manage-event'),
            'icon' => 'horn',
         ],
      ],
      'super_admin' => [
         [
            'title' => 'Manajemen User',
            'isActive' => request()->routeIs('super-admin.manage-user*'),
            'to' => route('super-admin.manage-user'),
            'icon' => 'user-solid',
         ],
         [
            'title' => 'Pengaturan',
            'isActive' => request()->routeIs('super-admin.settings*'),
            'to' => route('super-admin.settings'),
            'icon' => 'gear',
         ],
      ],
   };
@endphp

<body class="font-inter bg-soft-blue">
   <div class="">
      <nav class="fixed top-0 left-0 flex min-h-screen w-72.5 flex-col bg-white pt-14">
         <div class="relative mx-auto mb-5.5 w-fit flex-none px-8.25">
            <h1 class="text-2xl font-bold text-[#2B3674]">
               {{ $userRole == 'admin' ? 'ADMIN' : 'SUPER ADMIN' }} EVENT
            </h1>
            <h2 class="text-2xl font-bold text-[#2B3674]">
               Hi!
               <span class="uppercase">{{
                  auth()->user()?->username ??
                     ($userRole == 'admin' ? 'Admin' : 'Super Admin')
               }}</span>
            </h2>
         </div>
         <div class="relative flex w-full flex-1 flex-col py-10.25 pl-8.25">
            <div class="absolute top-0 left-0 h-px w-72.5 bg-[#F4F7FE]"></div>
            <div class="flex flex-1 flex-col gap-4">
               @foreach ($menus as $menu)
                  <x-navlink
                     icon="{{ $menu['icon'] }}"
                     href="{{ $menu['to'] }}"
                     isActive="{{ $menu['isActive'] }}"
                     iconClass="!text-[#4318FF] !size-4.5"
                     >{{ $menu['title'] }}</x-navlink
                  >
               @endforeach
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
               @csrf
               <x-navlink
                  type="submit"
                  icon="logout"
                  class="cursor-pointer"
                  iconClass="!text-[#4318FF] !size-4.5"
                  >Logout</x-navlink
               >
            </form>
         </div>
      </nav>
      <main class="ml-72.5 min-h-screen">
         @if (isset($slot))
            {{ $slot }}
         @else
            @yield ('content')
         @endif
      </main>
   </div>

   @livewireScripts
</body>
</html>
