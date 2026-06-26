@props(['icon' => '', 'classText' => '', ])

<span {{ $attributes->merge(['class' => 'py-2 px-3 rounded-lg bg-primary flex items-center gap-2']) }}>
     @if ($icon)
          <x-dynamic-component class="text-white" component="icons.{{ $icon }}" />
     @endif
     <p class="{{ $classText }} font-medium text-white">{{ $slot }}</p>
</span>