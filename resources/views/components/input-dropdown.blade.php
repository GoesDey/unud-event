@props ([
   'label' => '',
   'name' => '',
   'options' => [],
   'multiple' => false,
   'placeholder' => 'Cari...',
   'wireModel' => null,
   'classLabel' => ''
])

<div
   class="relative flex flex-col gap-1"
   x-data="selectDropdown({ options: {{ Js::from($options) }}, multiple: {{ $multiple ? 'true' : 'false' }}, wireModel: '{{ $wireModel }}',
   initial: {{ Js::from($wireModel ? ($multiple ? (array)($__livewire->{$wireModel} ?? []) : ($__livewire->{$wireModel} ?? '')) : ($multiple ? '[]' : "''")) }}
   })"
   @click.outside="open = false"
>
   @if ($label)
      <label class="mb-1.5 block select-none font-semibold {{ $classLabel }}">{{ $label }}</label>
   @endif

   {{-- Hidden input --}}
   @if ($multiple)
      <template x-for="val in selected" :key="val">
         <input type="hidden" name="{{ $name }}[]" :value="val" />
      </template>
   @else
      <input type="hidden" name="{{ $name }}" :value="selected" />
   @endif

   {{-- Trigger --}}
   <div
      @class ([
         'flex min-h-11.5 cursor-pointer flex-wrap items-center gap-1.5 rounded-sm border border-[#CED4DA] bg-white px-3 py-2 text-sm',
         'border-red-500 focus:border-red-500' => $errors->has($wireModel)
      ])
      @click="open = !open"
   >
      @if ($multiple)
         <template x-if="selected.length === 0">
            <span class="text-[#001524]/40">{{ $placeholder }}</span>
         </template>
         <template x-for="val in selected" :key="val">
            <span
               class="flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-0.5 text-xs text-blue-700"
            >
               <span x-text="getLabel(val)"></span>
               <button type="button" class="cursor-pointer" @click.stop="toggle(val)">
                  &times;
               </button>
            </span>
         </template>
      @else
         <template x-if="selected === ''">
            <span class="text-[#001524]/40">{{ $placeholder }}</span>
         </template>
         <template x-if="selected !== ''">
            <span x-text="getLabel(selected)"></span>
         </template>
      @endif

      <x-icons.down-arrow class="ml-auto size-4 text-[#001524]/60" />
   </div>

   {{-- Dropdown --}}
   <div
      x-show="open"
      x-transition
      x-cloak
      class="absolute right-0 left-0 z-10 mt-1 rounded-[10px] border border-[#001524]/20 bg-white shadow-lg"
   >
      <div class="p-2">
         <input
            type="text"
            x-model="search"
            placeholder="Cari..."
            class="w-full rounded-lg border border-[#001524]/30 px-3 py-2 text-sm focus:outline-none"
            @click.stop
         />
      </div>

      <ul class="max-h-48 overflow-y-auto">
         <template x-for="option in filtered" :key="option.value">
            <li
               class="cursor-pointer px-4 py-2 text-sm hover:bg-gray-50"
               :class="isSelected(option.value) ? 'text-[#4318FF] font-semibold' : 'text-[#001524]'"
               @click="toggle(option.value)"
            >
               <span x-text="option.label"></span>
               <span x-show="isSelected(option.value)" class="float-right">
                  <x-icons.checklist class="size-4! text-[#4318FF]!" />
               </span>
            </li>
         </template>

         <template x-if="filtered.length === 0">
            <li class="px-4 py-3 text-center text-sm text-gray-400">Tidak ada hasil</li>
         </template>
      </ul>
   </div>
</div>
