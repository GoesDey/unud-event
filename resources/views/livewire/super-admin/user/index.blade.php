<div class="px-7.5 py-12.25">
   <livewire:admin.header-page
      :breadcrumbs="
         [
         ['label' => 'Manajemen User', 'url' => route('super-admin.manage-user')],
    ]
      "
      wire:model.live.debounce.300ms="search"
   />

   <div class="mt-7">
      <div class="mb-4.75 flex gap-3">
         {{-- <x-filter :filters="$sorts">
            <p class="px-4 pt-3 pb-1 text-xs text-gray-400">Nama Event</p>
            <button
               class="flex w-full cursor-pointer items-center justify-between px-4 py-2 text-left text-sm hover:bg-gray-50"
               :class="$wire.sorts.name === 'asc' ? 'text-blue-500 font-semibold' : ''"
               @click="$wire.addSort('name', 'asc')"
            >
               <span>A - Z</span>
               <span x-show="$wire.sorts.name === 'asc'" x-cloak>
                  <x-icons.checklist class="size-4!" />
               </span>
            </button>
            <button
               class="flex w-full cursor-pointer items-center justify-between px-4 py-2 text-left text-sm hover:bg-gray-50"
               :class="$wire.sorts.name === 'desc' ? 'text-blue-500 font-semibold' : ''"
               @click="$wire.addSort('name', 'desc')"
            >
               <span> Z - A </span>
               <span x-show="$wire.sorts.name === 'desc'" x-cloak>
                  <x-icons.checklist class="size-4!" />
               </span>
            </button>

            <hr class="my-1" />

            <p class="px-4 pt-1 pb-1 text-xs text-gray-400">Tanggal Event</p>
            <button
               class="flex w-full cursor-pointer items-center justify-between px-4 py-2 text-left text-sm hover:bg-gray-50"
               :class="$wire.sorts.start_date === 'asc' ? 'text-blue-500 font-semibold' : ''"
               @click="$wire.addSort('start_date', 'asc')"
            >
               <span>Terlama</span>
               <span x-show="$wire.sorts.start_date === 'asc'" x-cloak>
                  <x-icons.checklist class="size-4!" />
               </span>
            </button>
            <button
               class="flex w-full cursor-pointer items-center justify-between px-4 py-2 text-left text-sm hover:bg-gray-50"
               :class="$wire.sorts.start_date === 'desc' ? 'text-blue-500 font-semibold' : ''"
               @click="$wire.addSort('start_date', 'desc')"
            >
               <span>Terbaru</span>
               <span x-show="$wire.sorts.start_date === 'desc'" x-cloak>
                  <x-icons.checklist class="size-4!" />
               </span>
            </button>
         </x-filter>

         <x-filter title="Kategori" :filters="$filters['categories']" var="filters.categories">
            @foreach ($categories as $item)
               <button
                  class="w-full flex justify-between items-center cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['name']) && $filters['name'] === 'asc' ? 'text-blue-500 font-semibold' : '' }}"
                  @click="$wire.toggleFilter('category', {{ $item->id }})"
               >
                  <span
                     :class="$wire.filters.categories.includes({{ $item->id }}) ? 'text-[#4318FF] font-semibold' : '' "
                  >
                     {{ $item->name }}
                  </span>
                  <span x-show="$wire.filters.categories.includes({{ $item->id }})" x-cloak>
                     <x-icons.checklist class="size-4!" />
                  </span>
               </button>

            @endforeach
         </x-filter>
         <x-filter title="Tipe" :filters="$filters['type']" var="filters.type">
            @foreach ($types as $item)
               <button
                  class="w-full flex justify-between items-center cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['name']) && $filters['name'] === 'asc' ? 'text-blue-500 font-semibold' : '' }}"
                  @click="$wire.toggleFilter('type', {{ $item->id }})"
               >
                  <span
                     :class="$wire.filters.type == {{ $item->id }} ? 'text-[#4318FF] font-semibold' : ''"
                  >
                     {{ $item->name }}
                  </span>
                  <span x-show="$wire.filters.type == {{ $item->id }}" x-cloak>
                     <x-icons.checklist class="size-4!" />
                  </span>
               </button>

            @endforeach
         </x-filter> --}}

         <x-button
            :href="route('super-admin.manage-user.create')"
            class="w-fit! bg-[#000AFF] text-sm! font-normal! text-white"
         >
            <x-icons.plus class="size-4.5!" />
            <span>Tambah User</span>
         </x-button>
      </div>
      <x-table
         :theads="$theads"
         :data="$this->users"
         :showAction="count($deleteUsers) > 0"
         wire:model.live="selectAll"
         :endCols="['1.5fr', '1.5fr', '1.2fr', '1.5fr']"
      >
         @forelse ($this->users as $user)
            <x-table-row>
               <div class="justify-center">
                  <x-input
                     type="checkbox"
                     wire:model.live="deleteUsers"
                     value="{{ $user->id }}"
                     wire:key="checkbox-{{ $user->id }}"
                     class="items-center text-indigo-600 focus:ring-indigo-500"
                     classInput="cursor-pointer"
                  />
               </div>

               <div class="flex gap-3">
                  <img
                     class="size-8 shrink-0 overflow-hidden rounded-full border border-slate-300 bg-slate-200 object-cover"
                     src="https://ui-avatars.com/api/?name={{ urlencode($user->username ?? 'User') }}&background={{ substr(md5($user->username ?? 'User'), 0, 6) }}&color=fff"
                     alt="User Profile"
                  /><span> {{ $user->username }} </span>
               </div>
               <div>{{ $user->email }}</div>

               <div class="items-center">
                  <x-badge
                     class="h-fit px-2.5! py-1!"
                     variant="{{ $user->status ? 'green' : 'red' }}"
                  >
                     {{
                        $user->status
                           ? 'Aktif'
                           : 'Suspend'
                     }}
                  </x-badge>
               </div>

               <div class="justify-end space-x-3">
                  <x-button
                     class="w-fit! py-0! text-gray-500 transition-colors hover:text-red-500"
                     wire:click="deleteUser({{ $user->id }})"
                  >
                     <x-icons.trash class="size-5! text-inherit!" />
                  </x-button>
                  <x-button
                     class="w-fit! py-0! text-gray-500 transition-colors hover:text-indigo-600"
                     wire:navigate
                     {{-- :href="route('superadmin.manage-user.edit', $user)" --}}
                  >
                     <x-icons.pen class="size-5! text-inherit!" />
                  </x-button>
               </div>
            </x-table-row>

         @empty
            <div class="flex w-full flex-col items-center justify-center px-4 py-16 text-center">
               <div class="mb-4 rounded-full bg-slate-50 p-4">
                  <x-icons.folder class="size-10! fill-gray-500" />
               </div>

               <h3 class="mb-1 text-base font-bold text-slate-700">Belum Ada Event</h3>

               <p class="mb-6 max-w-sm text-sm text-slate-500">Anda belum membuat event apapun, atau event yang Anda cari tidak ditemukan dalam database.</p>
            </div>
         @endforelse
      </x-table>
   </div>
</div>
