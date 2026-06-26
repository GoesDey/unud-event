@props(['duration' => '700'])

<div x-data="{ show: false }" 
     x-intersect.once="show = true"
     style="transition-duration: {{ $duration }}ms;"
     {{ $attributes->merge(['class' => 'w-full block transition-all ease-out']) }}
     :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'">
     {{ $slot }}     
</div>