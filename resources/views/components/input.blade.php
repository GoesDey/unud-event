@props ([
   'label' => '',
   'name' => '',
   'type' => 'text',
   'classLabel' => '',
   'classInput' => '',
   'placeholder' => '',
   'icon' => '',
   'togglePass' => false
])

<div
   {{
      $attributes->class([
         'flex flex-col gap-1 ',
      ])
   }}
>
   @if ($label)
      <label for="{{ $name }}" @class (['font-semibold ', $classLabel])>{{ $label }}</label>
   @endif

   <div @class (['relative flex items-center']) @if ($togglePass) x-data="{ show: false }" @endif>
      @if ($icon)
         <div class="absolute inset-y-0 left-3 flex items-center">
            <x-dynamic-component
               :component="'icons.' . $icon"
               class="size-4.5! text-[#001524]/60!"
            />
         </div>
      @endif

      <input
         id="{{ $name }}"
         name="{{ $name }}"
         @if ($togglePass)
            :type="show ? 'text' : 'password'"
         @else
            type="{{ $type }}"
         @endif
         placeholder="{{ $placeholder }}"
         @class ([
            'rounded-[10px] w-full border border-[#001524]/60 text-[#001524] px-3 py-3 text-sm font-medium focus:border-black focus:outline-none',
            $classInput,
            'pl-10' => $icon
         ])
      />

      @if ($togglePass)
         <button
            type="button"
            class="absolute inset-y-0 right-3 flex cursor-pointer items-center text-gray-400 hover:text-gray-600"
            @click="show = !show"
         >
            <x-icons.eye x-show="!show" class="size-4.5 text-[#001524]!" />
            <x-icons.eye-off x-show="show" class="size-4.5 text-[#001524]!" />
         </button>
      @endif
   </div>

   @error ($name)
      <span class="text-sm text-red-500">{{ $message }}</span>
   @enderror
</div>
