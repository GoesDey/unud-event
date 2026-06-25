@props(['duration' => '700'])
<div x-data="{ show: false }" x-init="$nextTick(() => show = true)" x-show="show"
     x-transition:enter="transition ease-out"
     x-transition:enter-start="opacity-0 -translate-y-12"
     x-transition:enter-end="opacity-100 translate-y-0"
     style="transition-duration: {{ $duration }}ms;"
     {{ $attributes->merge(['class' => 'w-full block']) }}>
     {{ $slot }}     
</div>