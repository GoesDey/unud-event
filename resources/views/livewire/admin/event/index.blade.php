<div class="px-7.5 py-12.25">
   <livewire:admin.header-page
      :breadcrumbs="[['label' => 'Manajemen Event', 'url' => route('admin.manage-event')]]"
      wire:model.live.debounce.300ms="search"
   />

   <div class="mt-7">
      <div class="mb-4.75 flex gap-3">
         <x-filter :filters="$filters">
            <p class="px-4 pt-3 pb-1 text-xs text-gray-400">Nama Event</p>
            <button
               class="w-full cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['name']) && $filters['name'] === 'asc' ? 'text-blue-500 font-semibold' : '' }}"
               @click="$wire.filter('name', 'asc')"
            >
               A - Z
            </button>
            <button
               class="w-full cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['name']) && $filters['name'] === 'desc' ? 'text-blue-500 font-semibold' : '' }}"
               @click="$wire.filter('name', 'desc')"
            >
               Z - A
            </button>

            <hr class="my-1" />

            <p class="px-4 pt-1 pb-1 text-xs text-gray-400">Tanggal Event</p>
            <button
               class="w-full cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['start_date']) && $filters['start_date'] === 'asc' ? 'text-blue-500 font-semibold' : '' }}"
               @click="$wire.filter('start_date', 'asc')"
            >
               Terlama
            </button>
            <button
               class="w-full cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['start_date']) && $filters['start_date'] === 'desc' ? 'text-blue-500 font-semibold' : '' }}"
               @click="$wire.filter('start_date', 'desc')"
            >
               Terbaru
            </button>
         </x-filter>
         <x-filter title="Kategori" :filter="$categories" var="categories">
            <button
               class="w-full cursor-pointer px-4 py-2 text-left text-sm hover:bg-gray-50 {{ isset($filters['name']) && $filters['name'] === 'asc' ? 'text-blue-500 font-semibold' : '' }}"
               @click="$wire.filter('name', 'asc')"
            >
         </x-filter>

         <x-button
            wire:navigate
            :href="route('admin.manage-event.create')"
            class="w-fit! bg-[#000AFF] text-sm! font-normal! text-white"
         >
            <x-icons.plus class="size-4.5!" />
            <span>Tambah Event</span>
         </x-button>
      </div>
      <x-table
         :theads="$theads"
         :data="$this->events"
         :showAction="count($deleteEvents) > 0"
         wire:model.live="selectAll"
         :endCols="['1.5fr', '1fr', '1.3fr', '1fr', '1.5fr']"
      >
         @forelse ($this->events as $event)
            @php
               $statusConfig = [
                  'upcoming' => ['label' => 'Akan Datang', 'varian' => 'yellow'],
                  'ongoing' => ['label' => 'Berlangsung', 'varian' => 'blue'],
                  'ended' => ['label' => 'Berakhir', 'varian' => 'red'],
               ];

               $config = $statusConfig[$event->status_date];
            @endphp
            <x-table-row>
               <div class="justify-center">
                  <x-input
                     type="checkbox"
                     wire:model.live="deleteEvents"
                     value="{{ $event->id }}"
                     wire:key="checkbox-{{ $event->id }}"
                     class="items-center text-indigo-600 focus:ring-indigo-500"
                     classInput="cursor-pointer"
                  />
               </div>

               <div>
                  <div class="flex items-center space-x-3">
                     <img
                        class="aspect-square size-10 rounded-full border border-slate-200 object-cover"
                        src="{{ asset('storage/' . $event->picture) }}"
                        alt="Event Image"
                     />
                     <div class="flex flex-col">
                        <span class="font-semibold text-[#2d3359]">{{ $event->name }}</span>
                        <span class="text-xs text-slate-400">{{ $event->location }}</span>
                     </div>
                  </div>
               </div>

               <div>{{ $event->eventType->name }}</div>

               <div>
                  {{
                     $event->categories
                        ->pluck('name')
                        ->implode(', ')
                  }}
               </div>

               <div class="space-x-2">
                  <x-badge variant="{{ $event->status ? 'green' : 'red' }}">
                     {{
                        $event->status
                           ? 'Aktif'
                           : 'Suspend'
                     }}
                  </x-badge>
                  <x-badge variant="{{ $config['varian'] }}"> {{ $config['label'] }} </x-badge>
               </div>

               <div class="justify-end space-x-3">
                  <x-button
                     class="w-fit! py-0! text-gray-500 transition-colors hover:text-red-500"
                     wire:click="deleteEvent({{ $event->id }})"
                  >
                     <x-icons.trash class="size-5! text-inherit!" />
                  </x-button>
                  <x-button
                     class="w-fit! py-0! text-gray-500 transition-colors hover:text-indigo-600"
                     wire:navigate
                     :href="route('admin.manage-event.edit', $event)"
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
