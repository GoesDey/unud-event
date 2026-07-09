@props (['variant' => 'green', 'iconName' => null, 'iconClass' => ''])
<div
   {{
      $attributes->class([
         $iconName ? 'flex items-center' : 'text-center',
         'border rounded-[5px] text-sm p-1 w-fit',
         'bg-green-100 border-green-700 text-green-700' => $variant == 'green',
         'bg-red-100 border-red-700 text-red-700' => $variant == 'red',
         'bg-blue-100 border-blue-700 text-blue-700' => $variant == 'blue',
         'bg-yellow-100 border-yellow-700 text-yellow-700' => $variant == 'yellow',
      ])
   }}
>
   @if ($iconName)
      <x-dynamic-component
         class="text-inherit {{ $iconClass }}"
         component="icons.{{ $iconName }}"
      />
   @endif
   {{ $slot }}
</div>
