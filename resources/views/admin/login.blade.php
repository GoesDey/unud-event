<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Document</title>
   @vite (['resources/css/app.css'])
</head>
<body>
   <div class="font-inter flex h-screen w-full items-center justify-center">
      <div class="flex h-fit w-4/5 items-center">
         <div class="w-1/2">
            <img src="{{ asset('assets/img/login.svg') }}" alt="ilustrasi" />
         </div>
         <div
            class="flex w-1/2 flex-col justify-between self-stretch rounded-xl border border-[#000000]/40 px-16 py-12"
         >
            <div class="flex flex-col gap-3">
               <h1 class="text-secondary text-4xl font-bold">UNUD Events</h1>
               <h2 class="text-primary text-xl font-semibold">Pusat Informasi Event Udayana</h2>
               <p class="text-sm font-medium text-[#2B364A]">Selamat datang Admin!</p>
            </div>
            <form
               method="POST"
               action="{{ route('login.authenticate') }}"
               class="flex flex-col gap-3"
            >
               @csrf
               <x-input
                  classLabel="text-[#031459]"
                  label="Username"
                  name="username"
                  placeholder="Masukkan Username Anda...."
                  icon="user"
               />
               <x-input
                  label="Password"
                  classLabel="text-[#031459]"
                  name="password"
                  type="password"
                  togglePass
                  icon="key"
                  placeholder="Masukkan Password Anda...."
               />

               <x-input
                  type="checkbox"
                  label="Ingat perangkat ini"
                  class="flex-row-reverse! items-center gap-2.25!"
                  classLabel="text-[#888780]! font-normal! text-base"
                  classInput="w-fit!"
                  name="remember"
               />

               <x-button class="bg-[#192A84] text-white" type="submit">Masuk</x-button>
            </form>
         </div>
      </div>
   </div>
   @livewireScripts
</body>
</html>
