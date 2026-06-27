<div class="px-7.5 py-12.25">
   <livewire:admin.header-page
      :isSearch="false"
      :breadcrumbs="
         [
         ['label' => 'Manajemen Event', 'url' => route('admin.manage-event')],
         ['label' => 'Create Event', 'url' => route('admin.manage-event.create')],
    ]
      "
   />

   <div class="mt-7">
      <form>
         <h1 class="mb-4 text-2xl font-bold text-[#2B3674]">Tambah Event Baru!</h1>

         @if ($step == 1)
            {{-- Step 1 --}}
            <h2 class="mb-5 text-2xl font-bold text-[#2B3674]">Informasi Umum</h2>
            <div class="space-y-9">
               <div class="space-y-2.5">
                  @if ($picture && !$errors->has('picture'))
                     <img
                        src="{{ $picture->temporaryUrl() }}"
                        class="mx-auto mt-2 size-1/3 rounded-lg object-cover"
                     />
                  @endif
                  {{-- @dump ($picture) --}}
                  <label class="mb-1.5 block font-semibold">Foto/Poster Event</label>
                  <x-input
                     type="file"
                     name="picture"
                     wire:model.live="picture"
                     accept="image/jpg,image/jpeg,image/png,image/webp"
                     classInput="hidden"
                     classLabel="w-full cursor-pointer"
                     class="w-full"
                     @change="fileName = $event.target.files[0]?.name ?? ''"
                  >
                     <x-slot:label>
                        <span
                           @class ([
                              'block text-gray-700 bg-white rounded-[10px] w-full border text-[#001524] px-3 py-3 text-sm font-medium focus:outline-none',
                              'border-[#CED4DA]! focus:border-black' => !$errors->has('picture'),
                              'border-red-500 focus:border-red-500' => $errors->has('picture')
                           ])
                           >{{
                              $picture
                                 ? $picture->getClientOriginalName()
                                 : 'Pilih Gambar'
                           }}</span
                        >
                     </x-slot:label>
                  </x-input>
                  <x-input
                     label="Nama Event"
                     wire:model.live.debounce.300ms="name"
                     placeholder="Masukkan nama event kamu"
                     name="name"
                     classInput="bg-white rounded-sm"
                     borderClass="border-[#CED4DA]! focus:border-black"
                     classLabel="mb-1.5"
                  />
                  <x-input
                     type="text area"
                     wire:model.live.debounce.300ms="description"
                     label="Deskripsi Event"
                     name="description"
                     placeholder="Masukkan deskripsi event kamu"
                     classInput="bg-white rounded-sm"
                     borderClass="border-[#CED4DA]! focus:border-black"
                     classLabel="mb-1.5"
                  />
                  <div class="grid grid-cols-2 gap-6">
                     <x-input-date
                        label="Tanggal Mulai"
                        classLabel="mb-1.5"
                        model="start_date"
                        class="rounded-sm bg-white"
                        borderClass="border-[#CED4DA]!"
                     />

                     <x-input-date
                        label="Tanggal Selesai"
                        classLabel="mb-1.5"
                        model="end_date"
                        class="rounded-sm bg-white"
                        borderClass="border-[#CED4DA]!"
                     />
                  </div>
                  {{-- @dump($start_date) --}}
               </div>

               <div class="space-y-2.5">
                  <label class="mb-1.5 block font-semibold">Lokasi</label>
                  <div
                     @class ([
                        'grid grid-cols-2 gap-6',
                        'border border-red-500 focus:border-red-500 rounded-sm' => $errors->has('location')
                     ])
                     x-data="{ location: '{{ old('location', $location) }}' }"
                  >
                     <input type="hidden" name="location" :value="location" />
                     <x-input
                        type="checkbox"
                        class="flex-row justify-between gap-5! rounded-sm border border-[#CED4DA]! bg-white px-3 py-2"
                        classLabel="cursor-pointer select-none font-normal! text-base flex-1"
                        classInput="cursor-pointer"
                        label="Online"
                        name="online"
                        x-bind:checked="location === 'online'"
                        @click="
                           location = location === 'online' ? '' : 'online';
                           $wire.set('location', location);
                        "
                     />
                     <x-input
                        type="checkbox"
                        class="flex-row justify-between gap-5! rounded-sm border border-[#CED4DA]! bg-white px-3 py-2"
                        classLabel="cursor-pointer select-none font-normal! text-base flex-1"
                        classInput="cursor-pointer"
                        label="Offline"
                        name="offline"
                        x-bind:checked="location === 'offline'"
                        @click="
                           location = location === 'offline' ? '' : 'offline';
                           $wire.set('location', location);
                        "
                     />
                  </div>
                  @error ('location')
                     <span class="text-sm text-red-500">{{ $message }}</span>
                  @enderror

                  <x-input-dropdown
                     label="Tipe Event"
                     name="event_type_id"
                     wire-model="eventType"
                     :options="$types"
                     placeholder="Pilih tipe event..."
                  />
                  @error ('eventType')
                     <span class="text-sm text-red-500">{{ $message }}</span>
                  @enderror

                  <x-input-dropdown
                     label="Kategori"
                     name="categories"
                     wire-model="eventCategories"
                     :options="$categories"
                     placeholder="Pilih kategori..."
                     multiple
                  />
                  @error ('eventCategories')
                     <span class="text-sm text-red-500">{{ $message }}</span>
                  @enderror

                  <x-input-dropdown
                     label="Partisipan"
                     name="partisipan"
                     wire-model="eventParticipants"
                     :options="$participants"
                     placeholder="Pilih partisipan..."
                     multiple
                  />
                  @error ('eventParticipants')
                     <span class="text-sm text-red-500">{{ $message }}</span>
                  @enderror

                  <x-input
                     label="Biaya Event"
                     wire:model.live.debounce.300ms="price"
                     placeholder="Masukkan biaya (jika ada)"
                     name="price"
                     classInput="bg-white rounded-sm"
                     borderClass="border-[#CED4DA]! focus:border-black"
                     classLabel="mb-1.5"
                  />

                  <x-input
                     label="Link Pendaftaran"
                     wire:model.live.debounce.300ms="regisLink"
                     placeholder="Masukkan link pendaftaran"
                     name="regisLink"
                     classInput="bg-white rounded-sm"
                     borderClass="border-[#CED4DA]! focus:border-black"
                     classLabel="mb-1.5"
                  />
               </div>
            </div>

         @elseif ($step == 2)
            {{-- Step 2 --}}
            <h2 class="mb-5 text-2xl font-bold text-[#2B3674]">Informasi Detail</h2>
            <div class="space-y-5">
               @foreach ($details as $index => $detail)
                  <div
                     class="flex items-center gap-3 transition-all duration-1000"
                     x-data="{ hovered: false }"
                     @mouseenter="hovered = true"
                     @mouseleave="hovered = false"
                     x-transition
                  >
                     <div class="grid flex-1 grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1">
                           <x-input
                              :label="'Nama Info ' . $loop->iteration"
                              name="details.{{ $index }}.field"
                              wire:model="details.{{ $index }}.field"
                              placeholder="Contoh: Dress Code"
                              classInput="bg-white rounded-sm"
                              borderClass="border-[#CED4DA]! focus:border-black"
                              noError
                           />
                           @error ('details.' . $index . '.field')
                              <span class="text-sm text-red-500">{{ $message }}</span>
                           @enderror
                        </div>

                        <div class="flex flex-col gap-1">
                           <x-input
                              type="text area"
                              rows="4"
                              :label="'Isi Info ' . $loop->iteration"
                              name="details.{{ $index }}.value"
                              wire:model="details.{{ $index }}.value"
                              placeholder="Contoh: Formal"
                              classInput="bg-white rounded-sm"
                              borderClass="border-[#CED4DA]! focus:border-black"
                              noError
                           />
                           @error ('details.' . $index . '.value')
                              <span class="text-sm text-red-500">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <x-button
                        type="button"
                        x-cloak
                        wire:click="removeDetail({{ $index }})"
                        x-show="hovered"
                        x-transition
                        class="w-fit! text-gray-500 hover:text-red-700"
                     >
                        <x-icons.trash class="size-5 text-inherit!" />
                     </x-button>
                  </div>
               @endforeach

               <x-button
                  type="button"
                  wire:click="addDetail"
                  class="border border-dashed border-gray-500 text-gray-500 hover:border-[#2B3674] hover:text-[#2B3674]"
               >
                  <x-icons.plus />
               </x-button>
            </div>

         @elseif ($step == 3)
            {{-- Step 3 --}}
            <h2 class="mb-5 text-2xl font-bold text-[#2B3674]">Timeline</h2>
            <div class="space-y-5">
               @foreach ($timelines as $index => $timeline)
                  <div
                     class="space-y-3"
                     x-data="{ hovered: false }"
                     @mouseenter="hovered = true"
                     @mouseleave="hovered = false"
                     x-transition
                  >
                     <label class="mb-1.5 block font-semibold"
                        >Timeline {{ $loop->iteration }}</label
                     >
                     <div class="grid flex-1 grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1">
                           <x-input-date
                              label="Waktu Mulai"
                              classLabel="mb-1.5"
                              model="timelines.{{ $index }}.start"
                              type="datetime-local"
                              class="cursor-pointer rounded-sm bg-white select-none"
                              borderClass="border-[#CED4DA]!"
                           />
                        </div>

                        <div class="flex flex-col gap-1">
                           <x-input-date
                              label="Waktu Selesai"
                              classLabel="mb-1.5"
                              model="timelines.{{ $index }}.end"
                              type="datetime-local"
                              class="cursor-pointer rounded-sm bg-white"
                              borderClass="border-[#CED4DA]!"
                           />
                        </div>
                     </div>
                     <div class="flex">
                        <x-input
                           type="text area"
                           rows="3"
                           label="Deskripsi"
                           name="timelines.{{ $index }}.description"
                           wire:model="timelines.{{ $index }}.description"
                           placeholder="Deskripsi timeline..."
                           classInput="bg-white rounded-sm"
                           class="flex-1"
                           borderClass="border-[#CED4DA]! focus:border-black"
                        />
                        <x-button
                           type="button"
                           x-cloak
                           wire:click="removeTimeline({{ $index }})"
                           x-show="hovered"
                           x-transition
                           class="w-fit! text-gray-500 hover:text-red-700"
                        >
                           <x-icons.trash class="size-5 text-inherit!" />
                        </x-button>
                     </div>
                  </div>
               @endforeach
               <x-button
                  type="button"
                  wire:click="addTimeline"
                  class="border border-dashed border-gray-500 text-gray-500 hover:border-[#2B3674] hover:text-[#2B3674]"
               >
                  <x-icons.plus />
               </x-button>
            </div>

         @elseif ($step == 4)
            {{-- Step 4 --}}
            <h2 class="mb-5 text-2xl font-bold text-[#2B3674]">Informasi Penyelenggara</h2>
            <div class="space-y-3">
               <x-input
                  label="Lembaga"
                  wire:model.live.debounce.300ms="lembaga"
                  placeholder="Contoh: BEM FMIPA"
                  name="lembaga"
                  classInput="bg-white rounded-sm text-[#939BA2]!"
                  borderClass="border-[#CED4DA]! focus:border-black"
                  classLabel="mb-1.5"
                  readonly
               />
               <x-input
                  label="Instansi"
                  wire:model.live.debounce.300ms="instance"
                  placeholder="Contoh: Universitas Udayana"
                  name="instance"
                  classInput="bg-white rounded-sm"
                  borderClass="border-[#CED4DA]! focus:border-black"
                  classLabel="mb-1.5"
               />
               <x-input
                  label="Fakultas"
                  wire:model.live.debounce.300ms="faculty"
                  placeholder="Contoh: Matematika dan Ilmu Pengetahuan Alam"
                  name="faculty"
                  classInput="bg-white rounded-sm"
                  borderClass="border-[#CED4DA]! focus:border-black"
                  classLabel="mb-1.5"
               />
               <x-input
                  label="Program Studi"
                  wire:model.live.debounce.300ms="major"
                  placeholder="Contoh: Informatika"
                  name="major"
                  classInput="bg-white rounded-sm"
                  borderClass="border-[#CED4DA]! focus:border-black"
                  classLabel="mb-1.5"
               />
            </div>

         @endif

         <div class="mt-5 flex justify-between">
            <x-button
               class="w-fit! rounded-md! border border-slate-300 bg-white text-sm! font-medium! text-slate-700 hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
               wire:click="prevStep"
               :disabled="$step == 1"
               >Prev</x-button
            >
            <x-button
               class="w-fit! rounded-md! border border-slate-300 bg-white text-sm! font-medium! text-slate-700 hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-50"
               wire:click="{{ $step == $totalStep ? 'store' : 'nextStep' }}"
               >{{
                  $step == $totalStep
                     ? 'Simpan'
                     : 'Next'
               }}</x-button
            >
         </div>
      </form>
   </div>
</div>
