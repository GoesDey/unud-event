@aware ([
   'theads' => [],
   'startCol' => '60px',
   'endCols' => ['120px']
])

@php
   $endColsArray = is_array($endCols) ? $endCols : [$endCols];
   $dynamicFieldCount = max(0, count($theads) - (1 + count($endColsArray)));
   $middleCols = array_fill(0, $dynamicFieldCount, '1fr');
   $allCols = array_merge([$startCol], $middleCols, $endColsArray);
   $gridTemplate = implode(' ', $allCols);
@endphp

<div
   class="*:wrap-break-words grid w-full text-sm text-slate-600 transition-colors *:flex *:min-w-0 *:items-center *:px-4 *:py-4 hover:bg-slate-50"
   style="grid-template-columns: {{ $gridTemplate }};"
>
   {{ $slot }}
</div>
