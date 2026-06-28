<div class="px-7.5 py-12.25">
    <livewire:admin.header-page
      :breadcrumbs="[['label' => 'Pengaturan', 'url' => route('super-admin.settings')]]"
      wire:model.live.debounce.300ms="search"
   />
   <div class="mt-7 flex justify-between mb-4 pb-1">
        <div class="flex gap-6 items-center">
            <button 
                wire:click="changeTab('categories')" 
                class="text-2xl font-bold transition-all pb-2 cursor-pointer {{ $currentTab === 'categories' ? 'text-[#2B3674] border-b-4 border-[#4318FF]' : 'text-gray-400 hover:text-gray-600' }}">
                Kategori Event
            </button>

            <button 
                wire:click="changeTab('event_types')" 
                class="text-2xl font-bold transition-all pb-2 cursor-pointer {{ $currentTab === 'event_types' ? 'text-[#2B3674] border-b-4 border-[#4318FF]' : 'text-gray-400 hover:text-gray-600' }}">
                Tipe Event
            </button>

            <button 
                wire:click="changeTab('participants')" 
                class="text-2xl font-bold transition-all pb-2 cursor-pointer {{ $currentTab === 'participants' ? 'text-[#2B3674] border-b-4 border-[#4318FF]' : 'text-gray-400 hover:text-gray-600' }}">
                Peserta
            </button>
        </div>
        <x-button
            wire:click="openModal"
            class="w-fit! bg-[#000AFF] text-sm! font-normal! text-white"
         >
            <x-icons.plus class="size-4.5!" />
            <span>Tambah {{ $currentTab === 'event_types' ? 'Tipe Event' : ($currentTab === 'participants' ? 'Peserta' : 'Kategori Event') }}</span>
        </x-button>
    </div>
    <x-table wire:model.live="selectAll" :data="$data" :showAction="$selectAll || count($deleteEvents) > 0" :theads="$theads">
        @forelse($data as $item)
        <x-table-row>
            <div class="justify-center">
                <x-input
                    type="checkbox"
                    wire:model.live="deleteEvents"
                    value="{{ $item->id }}"
                    wire:key="checkbox-{{ $item->id }}"
                    class="items-center text-indigo-600 focus:ring-indigo-500"
                    classInput="cursor-pointer"
                />
            </div>

            <div class="px-4 py-3 flex items-center">
                {{ $item->name }}
            </div>

            @if($currentTab === 'event_types')
                <div class="px-4 py-3 flex items-center">
                    {{ $item->description }}
                </div>
            @endif

            <div class="justify-end space-x-3">
                <x-button
                    class="w-fit! py-0! text-gray-500 transition-colors hover:text-red-500"
                    wire:click="delete({{ $item->id }})" 
                    wire:confirm="Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan."
                >
                    <x-icons.trash class="size-5! text-inherit!" />
                </x-button>
                <x-button
                    class="w-fit! py-0! text-gray-500 transition-colors hover:text-indigo-600"
                    wire:click="edit({{ $item->id }})"
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
           <h3 class="mb-1 text-base font-bold text-slate-700">
                Belum Ada {{ $currentTab === 'event_types' ? 'Tipe Event' : ($currentTab === 'participants' ? 'Peserta' : 'Kategori Event') }} yang ditambahkan
           </h3>
        </div>
    @endforelse
    </x-table>
    @if($isOpenModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50">
        <div class="w-full max-w-xl bg-white overflow-hidden shadow-2xl animate-fade-in">
            <div class="bg-[#0007B3] px-6 py-4">
                <h2 class="text-white font-semibold text-base tracking-wide">
                    {{ $isEditMode ? 'Ubah ' : 'Tambahkan ' }} {{ $currentTab === 'event_types' ? 'Tipe Event Baru' : ($currentTab === 'participants' ? 'Peserta Baru' : 'Kategori Baru') }}
                </h2>
            </div>
            <form wire:submit.prevent="save" class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">
                        Nama {{ $currentTab === 'event_types' ? 'Tipe Event' : ($currentTab === 'participants' ? 'Peserta' : 'Kategori') }}
                    </label>
                    <input 
                        type="text" 
                        wire:model="name" 
                        placeholder="Masukkan nama..." 
                        class="w-full p-2.5 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 
                        @error('name') border-red-500 @enderror"
                    >
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                @if($currentTab === 'event_types')
                <div wire:key="description-field">
                    <label class="block text-sm font-bold text-slate-800 mb-2">Deskripsi</label>
                    <textarea 
                        wire:model="description" 
                        rows="4" 
                        placeholder="Masukkan deskripsi event kamu" 
                        class="w-full p-2.5 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 
                        @error('description') border-red-500 @enderror"
                    ></textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                @endif
                <div class="flex gap-3 pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2 bg-[#007BFF] text-white text-sm font-medium rounded-md hover:bg-blue-700 transition active:scale-95 cursor-pointer shadow-sm"
                    >
                        {{ $isEditMode ? 'Simpan Perubahan' : 'Tambah' }}
                    </button>
                    <button 
                        type="button" 
                        wire:click="closeModal" 
                        class="px-5 py-2 bg-[#FF0000] text-white text-sm font-medium rounded-md hover:bg-red-700 transition active:scale-95 cursor-pointer shadow-sm"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>