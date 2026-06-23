@props (['icon' => '', 'iconClass' => '', 'isActive' => false])

@if ($attributes->has('href'))
   <a
      wire:navigate
      {{
         $attributes->class([
            'font-bold text-[#2B3674] flex gap-4 items-center w-full h-full relative py-1.5',
         ])
      }}
   >
      @if ($icon)
         <x-dynamic-component :component="'icons.' . $icon" :class="$iconClass" />
      @endif
      {{ $slot }}
      @if ($isActive)
         <div class="absolute top-0 right-0 h-full w-1 rounded-3xl bg-[#4318FF]"></div>
      @endif
   </a>
@else
   <button
      wire:navigate
      {{
         $attributes->class([
            'font-bold text-[#2B3674] flex gap-4 items-center w-full h-full relative py-1.5',
         ])
      }}
   >
      @if ($icon)
         <x-dynamic-component :component="'icons.' . $icon" :class="$iconClass" />
      @endif
      {{ $slot }}
      @if ($isActive)
         <div class="absolute top-0 right-0 h-full w-1 rounded-3xl bg-[#4318FF]"></div>
      @endif
   </button>
@endif
