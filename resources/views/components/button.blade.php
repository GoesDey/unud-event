@props ([
   'type' => 'button'
])

<button
   {{
      $attributes->merge([
         'class' =>
            'w-full inline-flex items-center text-xl font-bold justify-center gap-2 px-4 py-2 rounded-xl transition-colors cursor-pointer',
         'type' => $type,
      ])
   }}
>
   {{ $slot }}
</button>
