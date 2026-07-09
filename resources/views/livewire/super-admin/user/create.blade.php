<div class="px-7.5 py-12.25">
   <livewire:admin.header-page
      :isSearch="false"
      :breadcrumbs="
         [
         ['label' => 'Manajemen User', 'url' => route('super-admin.manage-user')],
         ['label' => 'Create User', 'url' => route('super-admin.manage-user.create')],
    ]
      "
   />
   <div class="mt-7">
      {{-- @dump ($name, $username, $email, $password, $faculty, $major) --}}
      <form>
         <h1 class="mb-4 text-2xl font-bold text-[#2B3674]">Tambah User Baru!</h1>
         <h2 class="mb-5 text-2xl font-bold text-[#2B3674]">Informasi User</h2>
         <div class="space-y-9">
            <x-input
               label="Nama"
               wire:model.live.debounce.300ms="name"
               placeholder="Masukkan nama user"
               name="name"
               classInput="bg-white rounded-sm"
               borderClass="border-[#CED4DA]! focus:border-black"
               classLabel="mb-1.5"
            />
            <x-input
               label="Username"
               wire:model.live.debounce.300ms="username"
               placeholder="Masukkan username"
               name="username"
               classInput="bg-white rounded-sm"
               borderClass="border-[#CED4DA]! focus:border-black"
               classLabel="mb-1.5"
            />
            <x-input
               label="Email"
               wire:model.live.debounce.300ms="email"
               placeholder="Masukkan email"
               name="email"
               classInput="bg-white rounded-sm"
               borderClass="border-[#CED4DA]! focus:border-black"
               classLabel="mb-1.5"
            />
            <x-input
               label="Password"
               type="password"
               wire:model.live.debounce.300ms="password"
               placeholder="Masukkan password"
               name="password"
               classInput="bg-white rounded-sm"
               borderClass="border-[#CED4DA]! focus:border-black"
               classLabel="mb-1.5"
            />
            <x-input-dropdown
               label="Fakultas"
               name="faculty"
               wire-model="faculty"
               :options="$faculties"
               placeholder="Pilih fakultas"
            />
            <x-input-dropdown
               label="Program Studi"
               name="major"
               wire-model="major"
               :options="$majors"
               placeholder="Pilih program studi"
            />
            @error ('eventType')
               <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
            <div class="flex items-end justify-end font-semibold!">
               <x-button wire:click="store" class="w-fit! rounded-sm! bg-[#4318FF] text-white"
                  >Simpan</x-button
               >
            </div>
         </div>
      </form>
   </div>
</div>
